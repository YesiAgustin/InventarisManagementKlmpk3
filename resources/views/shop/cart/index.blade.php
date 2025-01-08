@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">Shopping Cart</h1>
    
    @if(count($cart ?? []) > 0)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Product</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-500">Price</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-500">Quantity</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-500">Subtotal</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $total = 0 @endphp
                    @foreach($products as $product)
                        @php 
                            $item = $cart[$product->id];
                            $subtotal = $product->harga * $item['jumlah'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/150" alt="{{ $product->nama }}" class="w-16 h-16 object-cover rounded">
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $product->nama }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right text-gray-500">
                                Rp {{ number_format($product->harga) }}
                            </td>
                            <td class="px-6 py-4 text-right text-gray-500">
                                {{ $item['jumlah'] }}
                            </td>
                            <td class="px-6 py-4 text-right font-medium text-gray-900">
                                Rp {{ number_format($subtotal) }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('shop.cart.remove', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-medium">Total:</td>
                        <td class="px-6 py-4 text-right font-bold text-xl">
                            Rp {{ number_format($total) }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            
            <div class="p-6 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-900">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Continue Shopping
                    </a>
                    <a href="{{ route('shop.checkout.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-gray-500 mb-4">
                <i class="fas fa-shopping-cart text-6xl"></i>
            </div>
            <h2 class="text-2xl font-medium text-gray-900 mb-4">Your cart is empty</h2>
            <p class="text-gray-500 mb-8">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('home') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection