<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $quantity = $this->faker->numberBetween(1, 5);

        return [
            'product_id' => $product->id,
            'user_id' => User::first()->id, // Menambahkan default user
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
            'sale_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}