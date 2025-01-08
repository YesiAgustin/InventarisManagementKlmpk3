<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        return view('shop.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.product.show', compact('product'));
    }
}