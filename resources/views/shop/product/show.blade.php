@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
   <!-- Breadcrumb -->
   <nav class="mb-8 text-sm">
       <ol class="flex items-center space-x-2">
           <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Home</a></li>
           <li><span class="text-gray-400">/</span></li>
           <li><a href="#" class="text-gray-500 hover:text-gray-700">{{ $product->kategori }}</a></li>
           <li><span class="text-gray-400">/</span></li>
           <li class="text-gray-900 font-medium">{{ $product->nama }}</li>
       </ol>
   </nav>

   <div class="grid lg:grid-cols-2 gap-12">
       <!-- Left: Image Gallery -->
       <div class="space-y-4" x-data="{ activeImage: 0 }">
           <div class="relative">
               <div class="aspect-square rounded-2xl overflow-hidden bg-gray-100">
                   <img src="{{ $product->image_url }}" class="w-full h-full object-cover" alt="{{ $product->nama }}">
               </div>
               
               <!-- Status Tags -->
               @if($product->stok < $product->stok_minimum)
                   <span class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">Limited Stock</span>
               @endif
           </div>

           <!-- Thumbnails -->
           <div class="grid grid-cols-4 gap-4 mt-4">
               @for($i = 0; $i < 4; $i++)
                   <div class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                       <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                   </div>
               @endfor
           </div>
       </div>

       <!-- Right: Product Info -->
       <div class="space-y-8">
           <!-- Basic Info -->
           <div>
               <h1 class="text-3xl font-bold mb-2">{{ $product->nama }}</h1>
               <div class="flex items-center space-x-4">
                   <div class="flex items-center">
                       <div class="flex text-yellow-400">
                           @for($i = 1; $i <= 5; $i++)
                               <i class="fas fa-star"></i>
                           @endfor
                       </div>
                       <span class="ml-2 text-gray-600">(4.8/5)</span>
                   </div>
                   <span class="text-gray-400">|</span>
                   <span class="text-gray-600">{{ rand(50,200) }} Reviews</span>
               </div>
           </div>

           <!-- Price & Stock -->
           <div class="space-y-4">
               <div class="flex items-baseline">
                   <span class="text-4xl font-bold text-indigo-600">Rp {{ number_format($product->harga) }}</span>
                   @if(isset($product->original_price) && $product->original_price > $product->harga)
                       <span class="ml-3 text-lg text-gray-400 line-through">Rp {{ number_format($product->original_price) }}</span>
                       <span class="ml-2 text-green-500">Save {{ round((1 - $product->harga/$product->original_price) * 100) }}%</span>
                   @endif
               </div>

               <div class="flex space-x-4">
                   <div class="flex-1 rounded-lg bg-gray-50 p-4">
                       <div class="text-sm text-gray-500">Stock Status</div>
                       <div class="flex items-center mt-1">
                           <div @class([
                               'w-3 h-3 rounded-full mr-2',
                               'bg-green-500' => $product->stok > $product->stok_minimum,
                               'bg-yellow-500' => $product->stok <= $product->stok_minimum && $product->stok > 0,
                               'bg-red-500' => $product->stok == 0,
                           ])></div>
                           <span class="font-medium">{{ $product->getStockStatus() }}</span>
                       </div>
                   </div>
                   <div class="flex-1 rounded-lg bg-gray-50 p-4">
                       <div class="text-sm text-gray-500">SKU</div>
                       <div class="font-medium mt-1">{{ $product->sku }}</div>
                   </div>
               </div>
           </div>

           <!-- Product Details -->
           <div class="space-y-4">
               <h3 class="font-medium">Product Details</h3>
               <div class="grid grid-cols-2 gap-4 text-sm">
                   <div>
                       <span class="text-gray-500">Category</span>
                       <p class="font-medium">{{ $product->kategori }}</p>
                   </div>
                   <div>
                       <span class="text-gray-500">Size</span>
                       <p class="font-medium">{{ $product->ukuran }}</p>
                   </div>
                   <div>
                       <span class="text-gray-500">Stock</span>
                       <p class="font-medium">{{ $product->stok }} units</p>
                   </div>
                   <div>
                       <span class="text-gray-500">Min. Order</span>
                       <p class="font-medium">1 unit</p>
                   </div>
               </div>
           </div>

           <!-- Add to Cart -->
           <div class="space-y-4">
               <div class="flex items-center space-x-4">
                   <div class="flex items-center border rounded-lg">
                       <button class="px-4 py-2 hover:bg-gray-50" @click="quantity > 1 && quantity--">−</button>
                       <input type="number" min="1" max="{{ $product->stok }}" class="w-20 text-center border-x py-2"
                              x-model="quantity">
                       <button class="px-4 py-2 hover:bg-gray-50" @click="quantity < {{ $product->stok }} && quantity++">+</button>
                   </div>
                   <span class="text-sm text-gray-500">{{ $product->stok }} units available</span>
               </div>

               <div class="grid grid-cols-2 gap-4">
                   <form action="{{ route('shop.cart.add', $product->id) }}" method="POST">
                       @csrf
                       <input type="hidden" name="quantity" :value="quantity">
                       <button type="submit" 
                               class="w-full bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg px-6 py-3 flex items-center justify-center space-x-2">
                           <i class="fas fa-shopping-cart"></i>
                           <span>Add to Cart</span>
                       </button>
                   </form>
                   <button class="w-full border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-50 rounded-lg px-6 py-3">
                       Buy Now
                   </button>
               </div>
           </div>

           <!-- Additional Features -->
           <div class="grid grid-cols-3 gap-4 pt-6 border-t">
               <div class="text-center">
                   <i class="fas fa-truck text-2xl text-gray-400 mb-2"></i>
                   <p class="text-sm text-gray-600">Free Shipping</p>
               </div>
               <div class="text-center">
                   <i class="fas fa-shield-alt text-2xl text-gray-400 mb-2"></i>
                   <p class="text-sm text-gray-600">1 Year Warranty</p>
               </div>
               <div class="text-center">
                   <i class="fas fa-undo text-2xl text-gray-400 mb-2"></i>
                   <p class="text-sm text-gray-600">30 Days Return</p>
               </div>
           </div>
       </div>
   </div>

   <!-- Product Description -->
   <div class="mt-16">
       <div class="border-b">
           <nav class="flex space-x-8" aria-label="Tabs">
               <button class="border-b-2 border-indigo-600 py-4 px-1 text-sm font-medium text-indigo-600">
                   Description
               </button>
               <button class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:border-gray-300">
                   Specifications
               </button>
               <button class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:border-gray-300">
                   Reviews
               </button>
           </nav>
       </div>

       <div class="py-8 prose max-w-none">
           <p class="text-gray-600">{{ $product->deskripsi }}</p>
       </div>
   </div>
</div>
@endsection

@push('styles')
<style>
.prose {
   max-width: 100%;
   color: #374 151;
}
.prose p {
   margin-top: 1.25em;
   margin-bottom: 1.25em;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
   Alpine.data('productGallery', () => ({
       images: Array(4).fill('{{ $product->image_url }}'),
       quantity: 1
   }))
})
</script>
@endpush