<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KewirausahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Hapus data lama (opsional, tapi bagus untuk testing)
        Sale::query()->delete();
        Product::query()->delete();

        // 2. Buat 10 produk baru menggunakan factory
        Product::factory(10)->create();

        // 3. Buat 50 data penjualan berdasarkan produk yang ada
        Sale::factory(50)->create();
    }
}