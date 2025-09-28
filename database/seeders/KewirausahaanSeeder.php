<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;

class KewirausahaanSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->info('Tidak ada user di database, KewirausahaanSeeder dilewati.');
            return;
        }

        Product::factory()->count(10)->create([
            'user_id' => $user->id,
        ]);

        Sale::factory()->count(50)->create([
            'user_id' => $user->id,
        ]);
    }
}