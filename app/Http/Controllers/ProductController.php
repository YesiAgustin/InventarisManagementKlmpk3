<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    /**
     * Menambahkan produk baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'sometimes|required|integer|min:0',
            'stok' => 'sometimes|required|integer|min:0',
            'sku' => 'sometimes|required|string|max:255|unique:products,sku',
            'kategori' => 'nullable|string|max:255',
            'ukuran' => 'nullable|string|max:255',
            'stok_minimum' => 'sometimes|required|integer|min:0',
            'stok_maximum' => 'sometimes|required|integer|min:0|gte:stok_minimum',
        ]);

        $product = Product::create($validated);

        return redirect(route('products.index'));
    }

    /**
     * Menampilkan detail produk.
     */
    public function show($id)
    {
        $product = Product::with('stockHistories')->find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Menampilkan edit produk.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Mengupdate produk.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'sometimes|required|integer|min:0',
            'stok' => 'sometimes|required|integer|min:0',
            'sku' => 'sometimes|required|string|max:255|unique:products,sku',
            'kategori' => 'nullable|string|max:255',
            'ukuran' => 'nullable|string|max:255',
            'stok_minimum' => 'sometimes|required|integer|min:0',
            'stok_maximum' => 'sometimes|required|integer|min:0|gte:stok_minimum',
        ]);

        $product->update($validated);

        return redirect(route('products.index'));
    }

    /**
     * Menghapus produk.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect(route('products.index'));
    }
}