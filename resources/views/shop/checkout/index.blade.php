@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-8">Checkout</h1>
        
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Order Summary</h2>
            @php $total = 0; @endphp
            @foreach($products as $product)
                @php 
                    $item = $cart[$product->id];
                    $subtotal = $product->harga * $item['jumlah'];
                    $total += $subtotal;
                @endphp
                <div class="flex justify-between py-2">
                    <div class="flex">
                        <img src="https://via.placeholder.com/50" class="w-12 h-12 object-cover rounded">
                        <div class="ml-4">
                            <p class="font-medium">{{ $product->nama }}</p>
                            <p class="text-gray-500">{{ $item['jumlah'] }} x Rp {{ number_format($product->harga) }}</p>
                        </div>
                    </div>
                    <p class="font-medium">Rp {{ number_format($subtotal) }}</p>
                </div>
            @endforeach
            
            <div class="border-t mt-4 pt-4">
                <div class="flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span>Rp {{ number_format($total) }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('shop.checkout.process') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition">
                    Pay Now with Midtrans
                </button>
            </form>
        </div>
    </div>
</div>
@endsection