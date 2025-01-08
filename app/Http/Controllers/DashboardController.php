<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $penjualan = Product::with('orders')
      ->get()
      ->map(function ($product) {
        // Calculate total quantity sold and total revenue
        $totalSold = $product->orders->sum('jumlah');
        $totalRevenue = $product->orders->sum('total_harga');

        return [
          'SKU' => $product->sku,
          'Produk' => $product->nama,
          'Kategori' => $product->kategori,
          'Jumlah Terjual' => $totalSold,
          'Total Harga' => $totalRevenue,
        ];
      });

    $penjualan = $penjualan->sortByDesc('Jumlah Terjual');

    $total_pesanan = Order::count();
    $total_pendapatan = $penjualan->sum('Total Harga');
    $produk_terlaris = $penjualan->first();

    return view(
      'dashboard.index',
      compact([
        'penjualan',
        'total_pesanan',
        'total_pendapatan',
        'produk_terlaris',
      ])
    );
  }

  public function laporan()
  {
    $penjualan = Product::with('orders')
      ->get()
      ->map(function ($product) {
        // Calculate total quantity sold and total revenue
        $totalSold = $product->orders->sum('jumlah');
        $totalRevenue = $product->orders->sum('total_harga');

        return [
          'SKU' => $product->sku,
          'Produk' => $product->nama,
          'Kategori' => $product->kategori,
          'Jumlah Terjual' => $totalSold,
          'Total Harga' => $totalRevenue,
        ];
      });

    $penjualan = $penjualan->sortByDesc('Jumlah Terjual');

    $pdf = Pdf::loadView('dashboard.laporan-penjualan', compact('penjualan'));

    // Return the PDF for download
    return $pdf->download('laporan-penjualan.pdf');
  }
}
