<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all(); // Mengambil semua pesanan
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products')); // Menampilkan formulir pembuatan pesanan
    }

    public function store(Request $request)
    {
        // Validasi dan simpan pesanan baru
        $validated = $request->validate([
            'id_product' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
        ]);

        // Ambil produk yang bersangkutan
        $product = Product::find($validated['id_product']);

        // Cek stok produk
        if ($product->stok < $validated['jumlah']) {
            return redirect()->back()->withErrors(['jumlah' => 'Stok tidak cukup untuk produk ini.']);
        }

        // Buat pesanan
        Order::create($validated);

        // Perbarui stok produk
        // $product->stok -= $validated['jumlah'];
        // $product->save();

        $product->deductStock($validated['jumlah']);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }



    public function show(Order $order)
    {
        return view('orders.show', compact('order')); // Menampilkan detail pesanan
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function reorder($id)
    {
        // Find the existing order
        $existingOrder = Order::with('product')->findOrFail($id);

        // Pass the order to the form view
        return view('orders.create', [
            'order' => $existingOrder,
            'products' => Product::all(), // To populate the product dropdown
        ]);
    }
}