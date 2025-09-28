<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->info('Tidak ada user di database, TransactionSeeder dilewati.');
            return;
        }
        
        Transaction::factory()->count(100)->create([
            'user_id' => $user->id,
        ]);
    }
}