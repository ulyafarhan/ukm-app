<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // Daftar contoh produk khas mahasiswa
        $products = [
            'Gantungan Kunci UKM', 'Stiker Logo UKM', 'Kaos Official UKM', 
            'Totebag Desain Keren', 'Mug Custom UKM', 'Blocknote Spiraled'
        ];

        return [
            'name' => $this->faker->randomElement($products) . ' ' . $this->faker->word(),
            'description' => 'Ini adalah deskripsi untuk produk merchandise UKM.',
            'price' => $this->faker->numberBetween(10, 50) * 1000, // Harga antara 10rb - 50rb
            'stock' => $this->faker->numberBetween(20, 100),
        ];
    }
}