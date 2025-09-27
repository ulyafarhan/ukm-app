<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionCategory;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Iuran Kas Anggota'],
            ['name' => 'Sponsorship'],
            ['name' => 'Biaya Acara'],
            ['name' => 'ATK'],
            ['name' => 'Lain-lain'],
        ];

        foreach ($categories as $category) {
            TransactionCategory::create($category);
        }
        
        Transaction::factory(50)->create();
    }
}