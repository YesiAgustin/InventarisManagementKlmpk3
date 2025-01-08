<?php

use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route utama mengarah ke product list untuk publik
Route::get('/', [ShopController::class, 'index'])->name('home');

// Route untuk guest/public
Route::group(['prefix' => 'shop'], function () {
  Route::get('/', [ShopController::class, 'index'])->name('shop.index');
  Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.product.show');

  // Cart routes
  Route::get('/cart', [CartController::class, 'index'])->name('shop.cart.index');
  Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('shop.cart.add');
  Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('shop.cart.remove');
  Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('shop.cart.update');
});

// Route yang perlu login (checkout & payment)
Route::group(['prefix' => 'shop', 'middleware' => ['auth']], function () {
  Route::get('/checkout', [CheckoutController::class, 'index'])->name('shop.checkout.index');
  Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('shop.checkout.process');
  Route::get('/payment/finish', [CheckoutController::class, 'finish'])->name('shop.payment.finish');
});

// Route untuk Admin (dengan middleware auth)
Route::middleware(['auth', 'role:admin'])->group(function () {
  // Dashboard Laporan Penjualan
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('dashboard/laporan-penjualan', [DashboardController::class, 'laporan'])->name('dashboard.laporan');

  // Products Management
  Route::resource('products', ProductController::class);

  // Orders Management 
  Route::resource('orders', OrderController::class)->only([
    'index',
    'create',
    'store',
    'show',
    'destroy',
  ]);
  Route::get('orders/{id}/reorder', [OrderController::class, 'reorder'])->name('orders.reorder');

  // Stock Management
  Route::get('/restock/{id}', [StockController::class, 'restockProduct'])->name('restock.product');
  Route::post('/restock', [StockController::class, 'save'])->name('restock.save');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
  Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
});

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Midtrans Notification Handler (webhook)
Route::post('payments/midtrans/notification', [CheckoutController::class, 'notification']);
Route::get('payments/midtrans/finish', [CheckoutController::class, 'finish'])->name('payments.finish');
Route::get('payments/midtrans/unfinish', [CheckoutController::class, 'unfinish'])->name('payments.unfinish');
Route::get('payments/midtrans/error', [CheckoutController::class, 'error'])->name('payments.error');
