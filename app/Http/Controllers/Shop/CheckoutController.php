<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller 
{
   public function __construct()
   {
       Config::$serverKey = config('midtrans.server_key');
       Config::$isProduction = config('midtrans.is_production');
       Config::$isSanitized = true;
       Config::$is3ds = true;
   }

   public function index()
   {
       try {
           $cart = session()->get('cart', []);
           if(empty($cart)) {
               return redirect()->route('shop.cart.index')->with('error', 'Your cart is empty');
           }

           $products = Product::whereIn('id', array_keys($cart))->get();
           $total = $this->calculateTotal($cart);
           
           return view('shop.checkout.index', compact('cart', 'products', 'total'));
       } catch(\Exception $e) {
           return redirect()->back()->with('error', 'Something went wrong. Please try again.');
       }
   }

   public function process(Request $request)
   {
       try {
           $cart = session()->get('cart');
           $total = $this->calculateTotal($cart);

           $order = Order::create([
               'id_product' => array_key_first($cart),
               'jumlah' => array_sum(array_column($cart, 'jumlah')),
               'total_harga' => $total 
           ]);

           $params = [
               'transaction_details' => [
                   'order_id' => $order->id,
                   'gross_amount' => $total
               ]
           ];

           $snapToken = Snap::getSnapToken($params);
           return view('shop.checkout.payment', compact('snapToken', 'order'));

       } catch(\Exception $e) {
           return redirect()->back()->with('error', 'Payment processing failed. Please try again later.');
       }
   }

   public function finish(Request $request)
   {
       try {
           $orderId = $request->order_id;
           $status = $request->transaction_status;

           $order = Order::findOrFail($orderId);

           if ($status == 'capture' || $status == 'settlement') {
               $order->update(['status' => 'paid']);
               session()->forget('cart');
               return redirect()->route('shop.index')->with('success', 'Payment successful!');
           } 
           else if ($status == 'pending') {
               $order->update(['status' => 'pending']);
               return redirect()->route('shop.index')->with('info', 'Payment is pending. Please complete your payment.');
           }
           else {
               $order->update(['status' => 'failed']);
               return redirect()->route('shop.index')->with('error', 'Payment failed.');
           }

       } catch(\Exception $e) {
           return redirect()->route('shop.index')->with('error', 'Something went wrong. Please contact support.');
       }
   }

   private function calculateTotal($cart)
   {
       try {
           $total = 0;
           foreach($cart as $id => $item) {
               $product = Product::find($id);
               $total += $product->harga * $item['jumlah'];
           }
           return $total;
       } catch(\Exception $e) {
           throw new \Exception('Error calculating total');
       }
   }
}