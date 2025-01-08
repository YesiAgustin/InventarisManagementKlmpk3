<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->nullable();
            $table->string('kategori')->nullable();
            $table->string('ukuran')->nullable();
            $table->integer('stok_minimum')->nullable();
            $table->integer('stok_maximum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['sku', 'kategori', 'ukuran', 'stok_minimum', 'stok_maksimum']);
        });
    }
};