<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MemberSeeder::class,
            EventSeeder::class,
            DocumentSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}