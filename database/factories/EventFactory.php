<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'date' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'location' => $this->faker->city(),
        ];
    }
}