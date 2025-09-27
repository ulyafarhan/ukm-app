<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RolesAndPermissionsSeeder::class,
            MemberSeeder::class,
            EventSeeder::class,
            DocumentSeeder::class,
            TransactionSeeder::class,
            KewirausahaanSeeder::class,
            PostSeeder::class,
        ]);
    }
}