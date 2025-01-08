<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
  protected $model = Product::class;

  public function definition()
  {
    return [
      'nama' => $this->faker->unique()->word() . ' ' . $this->faker->word(), // Generate a realistic clothing name
      'deskripsi' => $this->faker->sentence(10), // Generate a short description
      'harga' => ($this->faker->numberBetween(100, 1000) * 1000), // Price between 100,000 and 1,000,000
      'stok' => $this->faker->numberBetween(1, 100), // Stock between 1 and 100
      'sku' => strtoupper($this->faker->lexify('????')) . $this->faker->numberBetween(1000, 9999), // SKU format
      'kategori' => $this->faker->randomElement(['Men\'s Fashion', 'Women\'s Fashion', 'Kids\' Fashion']), // Clothing categories
      'ukuran' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']), // Sizes
      'stok_minimum' => $this->faker->numberBetween(1, 10), // Minimum stock
      'stok_maximum' => $this->faker->numberBetween(50, 200), // Maximum stock
    ];
  }
}
