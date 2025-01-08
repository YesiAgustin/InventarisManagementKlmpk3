<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  protected $table = 'products';
  protected $appends = ['image_url'];
  protected $fillable = [
    'nama',
    'deskripsi',
    'harga',
    'stok',
    'sku',
    'kategori',
    'ukuran',
    'stok_minimum',
    'stok_maximum',
  ];

  public function orders()
  {
    return $this->hasMany(Order::class, 'id_product');
  }

  // Relationship with stock history
  public function stockHistories()
  {
    return $this->hasMany(StockHistory::class);
  }

  // Restocking method
  public function restock(int $quantity, $supplier, $notes)
  {
    // Add quantity to stock
    $this->increment('stok', $quantity);

    // Determine the source of the restock
    $source = $quantity < 0 ? "Removal" : "Restock";

    // Log the restock action
    $this->stockHistories()->create([
      'quantity' => $quantity,
      'source' => $source,
      'supplier' => $supplier,
      'notes' => $notes,
    ]);
  }

  // Method to deduct stock for orders
  public function deductStock(int $quantity)
  {
    // Deduct quantity from stock
    $this->decrement('stok', $quantity);

    // Log the order deduction
    $this->stockHistories()->create([
      'quantity' => -$quantity,
      'source' => 'Order',
    ]);
  }

  // Get stock status
  public function getStockStatus()
  {
    if ($this->stok > $this->stok_maximum) {
      return 'Overstock';
    }

    if ($this->stok < $this->stok_minimum) {
      return 'Low Stock';
    }

    return 'Normal Stock';
  }

  // Get image URL based on category
  public function getImageUrlAttribute()
  {
    $images = [
      'Men\'s Fashion' => [
        'https://images.unsplash.com/photo-1517059224940-d4af9eec41b7',
        'https://images.unsplash.com/photo-1492707892479-7bc8d5a4ee93',
        'https://images.unsplash.com/photo-1503919545889-aef636e10ad4'
      ],
      'Women\'s Fashion' => [
        'https://images.unsplash.com/photo-1445205170230-053b83016050',
        'https://images.unsplash.com/photo-1492707892479-7bc8d5a4ee93',
        'https://images.unsplash.com/photo-1483985988355-763728e1935b'
      ],
      'Kids\' Fashion' => [
        'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4',
        'https://images.unsplash.com/photo-1519340241574-2cec6aef0c01',
        'https://images.unsplash.com/photo-1503919545889-aef636e10ad4'
      ]
    ];

    $categoryImages = $images[$this->kategori] ?? $images['Men\'s Fashion'];
    return $categoryImages[array_rand($categoryImages)];
  }
}
