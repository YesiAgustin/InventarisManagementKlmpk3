<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Tokko Baju') }}</title>
    
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Styles -->
    <style>
        .hero-pattern {
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <header x-data="{ open: false }" class="bg-white shadow-lg fixed w-full z-50">
        <nav class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <i class="fas fa-store text-indigo-600 text-2xl"></i>
                        <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 text-transparent bg-clip-text">
                            {{ config('app.name', 'Tokko Baju') }}
                        </span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 transition">Home</a>
                    <a href="#new-arrivals" class="text-gray-600 hover:text-indigo-600 transition">New Arrivals</a>
                    <a href="#categories" class="text-gray-600 hover:text-indigo-600 transition">Categories</a>
                    
                    <!-- Cart -->
                    <a href="{{ route('shop.cart.index') }}" class="relative group">
                        <i class="fas fa-shopping-cart text-gray-600 group-hover:text-indigo-600 transition text-xl"></i>
                        @if(session()->has('cart'))
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    <!-- Auth -->
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-indigo-600 transition">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" class="w-8 h-8 rounded-full">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-lg shadow-xl">
                                <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 ">
                                    <i class="fas fa-user mr-2"></i> Profile
                                </a>
                                <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                                    <i class="fas fa-shopping-bag mr-2"></i> My Orders
                                </a>
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <button @click="open = !open" class="md:hidden text-gray-600">
                    <i x-show="!open" class="fas fa-bars text-2xl"></i>
                    <i x-show="open" class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" class="md:hidden mt-4">
                <a href="{{ route('home') }}" class="block py-2 text-gray-600 hover:text-indigo-600">Home</a>
                <a href="#new-arrivals" class="block py-2 text-gray-600 hover:text-indigo-600">New Arrivals</a>
                <a href="#categories" class="block py-2 text-gray-600 hover:text-indigo-600">Categories</a>
            </div>
        </nav>
    </header>

    <!-- Messages -->
    @if(session('success'))
        <div class="fixed top-20 right-4 z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <!-- Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">About Us</h3>
                    <p class="text-gray-400">Your trusted online shopping destination for quality products and excellent service.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Products</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Contact Us</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt w-6"></i>
                            123 Shopping Street
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone w-6"></i>
                            +1 234 567 890
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope w-6"></i>
                            info@example.com
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>