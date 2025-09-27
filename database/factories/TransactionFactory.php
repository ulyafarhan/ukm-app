<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TransactionCategory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transaction_category_id' => TransactionCategory::inRandomOrder()->first()->id,
            'amount' => $this->faker->numberBetween(25000, 1000000),
            'description' => $this->faker->sentence(),
            'transaction_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'type' => $this->faker->randomElement(['income', 'expense']),
        ];
    }
}