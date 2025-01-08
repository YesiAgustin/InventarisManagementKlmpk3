<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{

    private $dummySuppliers = [
        'Pusat Fashion - +62 812-3456-7890',
        'Toko Trendy - +62 813-4567-8901',
        'Gaya Terkini - +62 814-5678-9012',
        'Pakaian Modis - +62 815-6789-0123',
        'Busana Urban - +62 816-7890-1234',
        'Elite Fashion - +62 817-8901-2345',
        'Vogue Indonesia - +62 818-9012-3456',
        'Couture Klasik - +62 819-0123-4567',
        'Wardrobe Modern - +62 820-1234-5678',
        'Fashion Hub Indonesia - +62 821-2345-6789',
    ];

    public function restockProduct($id)
    {
        $suppliers = $this->dummySuppliers;
        $product = Product::findOrFail($id);
        return view('stock.restock', compact('product', 'suppliers'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'jumlah' => 'required|integer',
            'supplier' => 'nullable|string',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($request->id);

        // Update the product's stock
        $product->restock($request->jumlah, $request->supplier, $request->deskripsi);

        // Redirect to the products list with a success message
        return redirect()->route('products.show', $product->id)->with('success', 'Restok produk berhasil');
    }
}