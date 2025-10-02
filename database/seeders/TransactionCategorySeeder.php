<?php

namespace Database\Seeders;

use App\Models\TransactionCategory;
use Illuminate\Database\Seeder;

class TransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionCategory::create(['name' => 'Iuran Wajib Anggota']);
        TransactionCategory::create(['name' => 'Uang Kas']);
        TransactionCategory::create(['name' => 'Dana Kegiatan']);
        TransactionCategory::create(['name' => 'Sponsorship']);
        TransactionCategory::create(['name' => 'Penjualan Produk']);
        TransactionCategory::create(['name' => 'Biaya Operasional']);
        TransactionCategory::create(['name' => 'Pembelian Aset']);
    }
}