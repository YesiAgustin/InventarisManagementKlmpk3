<!-- Homepage (views/shop/index.blade.php) -->
@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-pink-500 to-purple-600 text-white overflow-hidden">
   <div class="absolute inset-0">
       <img src="{{ asset('images/hero-bg.jpg') }}" class="w-full h-full object-cover opacity-30">
   </div>
   <div class="container mx-auto px-4 py-32 relative">
       <div class="max-w-3xl">
           <h1 class="text-6xl font-extrabold mb-6">Fashion That Speaks</h1>
           <p class="text-xl mb-8">Explore the latest trends and styles at unbeatable prices.</p>
           <div class="flex gap-4">
               <a href="#categories" 
                  class="bg-white text-pink-600 px-8 py-4 rounded-lg shadow-lg hover:bg-gray-100 transition">
                   Shop Now
               </a>
               <a href="#new-arrivals"
                  class="border-2 border-white text-white px-8 py-4 rounded-lg hover:bg-white/10 transition">
                   New Arrivals
               </a>
           </div>
       </div>
   </div>
</div>

<!-- Categories -->
<section id="categories" class="py-16 bg-gray-50">
   <div class="container mx-auto px-4">
       <div class="text-center mb-12">
           <h2 class="text-4xl font-bold mb-4">Shop by Category</h2>
           <p class="text-gray-600">Find your perfect outfit</p>
       </div>
       <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
           @php
           $categories = [
               'Men\'s Fashion' => [
                   'icon' => 'fas fa-tshirt',
                   'image' => 'mens-fashion.jpg',
                   'items' => '1,200+ items',
                   'color' => 'from-blue-500 to-blue-700'
               ],
               'Women\'s Fashion' => [
                   'icon' => 'fas fa-female',
                   'image' => 'womens-fashion.jpg', 
                   'items' => '2,500+ items',
                   'color' => 'from-pink-500 to-pink-700'
               ],
               'Kids\' Fashion' => [
                   'icon' => 'fas fa-baby',
                   'image' => 'kids-fashion.jpg',
                   'items' => '800+ items', 
                   'color' => 'from-green-500 to-green-700'
               ]
           ];
           @endphp

           @foreach($categories as $name => $cat)
           <div class="group relative rounded-xl overflow-hidden shadow-xl hover:shadow-2xl transition duration-300">
               <div class="absolute inset-0 bg-gradient-to-r {{ $cat['color'] }} opacity-90 group-hover:opacity-95 transition"></div>
               <img src="{{ asset('images/categories/' . $cat['image']) }}" 
                    class="w-full h-80 object-cover group-hover:scale-110 transition duration-500">
               <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-6">
                   <i class="{{ $cat['icon'] }} text-5xl mb-4"></i>
                   <h3 class="text-2xl font-bold mb-2">{{ $name }}</h3>
                   <p class="text-lg opacity-90">{{ $cat['items'] }}</p>
                   <span class="mt-4 bg-white/20 px-6 py-2 rounded-full backdrop-blur-sm group-hover:bg-white group-hover:text-gray-900 transition-all">
                       Explore
                   </span>
               </div>
           </div>
           @endforeach
       </div>
   </div>
</section>

<!-- New Arrivals -->
<section id="new-arrivals" class="py-16">
   <div class="container mx-auto px-4">
       <div class="flex justify-between items-end mb-12">
           <div>
               <h2 class="text-4xl font-bold mb-2">New Arrivals</h2>
               <p class="text-gray-600">Latest styles just for you</p>
           </div>
           <div class="flex gap-2">
               <button class="p-2 rounded-full border hover:bg-gray-50" id="prev-products">
                   <i class="fas fa-arrow-left"></i>
               </button>
 <button class="p-2 rounded-full border hover:bg-gray-50" id="next-products">
                   <i class="fas fa-arrow-right"></i>
               </button>
           </div>
       </div>

       <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
           @foreach($products->sortByDesc('created_at')->take(8) as $product)
           <div class="bg-white rounded-xl shadow-lg overflow-hidden group">
               <div class="relative aspect-square overflow-hidden">
                   <img src="{{ $product->image_url }}" 
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                   <div class="absolute top-4 right-4">
                       <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm">New</span>
                   </div>
                   <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 
                               flex items-center justify-center gap-4">
                       <a href="{{ route('shop.product.show', $product->id) }}" 
                          class="bg-white text-gray-900 p-3 rounded-full hover:bg-gray-100 transition">
                           <i class="fas fa-eye"></i>
                       </a>
                       <form action="{{ route('shop.cart.add', $product->id) }}" method="POST" class="inline">
                           @csrf
                           <button class="bg-white text-gray-900 p-3 rounded-full hover:bg-gray-100 transition">
                               <i class="fas fa-shopping-cart"></i>
                           </button>
                       </form>
                       <button onclick="toggleWishlist({{ $product->id }})"
                               class="bg-white text-gray-900 p-3 rounded-full hover:bg-gray-100 transition">
                           <i class="far fa-heart"></i>
                       </button>
                   </div>
               </div>
               <div class="p-6">
                   <div class="mb-3">
                       <span class="text-sm text-gray-500">{{ $product->kategori }}</span>
                       <h3 class="font-bold text-lg">{{ $product->nama }}</h3>
                   </div>
                   <div class="flex items-center justify-between">
                       <span class="text-xl font-bold text-pink-600">
                           Rp {{ number_format($product->harga) }}
                       </span>
                       <div class="flex text-yellow-400 text-sm">
                           @for($i = 0; $i < 5; $i++)
                               <i class="fas fa-star"></i>
                           @endfor
                           <span class="text-gray-500 ml-1">(4.8)</span>
                       </div>
                   </div>
               </div>
           </div>
           @endforeach
       </div>
   </div>
</section>

<!-- Features -->
<section class="py-16 bg-gray-50">
   <div class="container mx-auto px-4">
       <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
           @php
           $features = [
               [
                   'icon' => 'fas fa-truck',
                   'title' => 'Free Shipping',
                   'description' => 'On orders over Rp 500k'
               ],
               [
                   'icon' => 'fas fa-sync',
                   'title' => 'Easy Returns',
                   'description' => '30 day return policy'
               ],
               [
                   'icon' => 'fas fa-shield-alt',
                   'title' => 'Secure Payment',
                   'description' => '100% secure checkout'
               ],
               [
                   'icon' => 'fas fa-headset',
                   'title' => '24/7 Support',
                   'description' => 'Talk to us anytime'
               ]
           ];
           @endphp

           @foreach($features as $feature)
           <div class="text-center p-8 bg-white rounded-xl shadow-lg hover:shadow-xl transition">
               <i class="{{ $feature['icon'] }} text-4xl text-pink-600 mb-4"></i>
               <h3 class="font-bold text-xl mb-2">{{ $feature['title'] }}</h3>
               <p class="text-gray-600">{{ $feature['description'] }}</p>
           </div>
           @endforeach
       </div>
   </div>
</section>

<!-- Newsletter -->
<section class="py-16 bg-gradient-to-r from-pink-600 to-purple-600 text-white">
   <div class="container mx-auto px-4">
       <div class="max-w-2xl mx-auto text-center">
           <h2 class="text-4xl font-bold mb-4">Stay Updated</h2>
           <p class="mb-8">Subscribe to our newsletter for exclusive deals and updates</p>
           <form class="flex gap-4 max-w-md mx-auto">
               <input type="email" placeholder="Enter your email" 
                      class="flex-1 px-4 py-3 rounded-lg text-gray-900">
               <button type="submit" class="bg-white text-pink-600 px-8 py-3 rounded-lg hover:bg-gray-100 transition">
                   Subscribe
               </button>
           </form>
       </div>
   </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script>
// Initialize sliders, add animations etc
document.addEventListener('DOMContentLoaded', function() {
   const productSlider = new Swiper('.product-slider', {
       slidesPerView: 1,
       spaceBetween: 30,
       navigation: {
           nextEl: '#next-products',
           prevEl: '#prev-products',
       },
       breakpoints: {
           640: { slidesPerView: 2 },
           768: { slidesPerView: 3 },
           1024: { slidesPerView: 4 },
       }
   });
});

function toggleWishlist(productId) {
   // Add wishlist functionality
}
</script>
@endpush