<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        $majors = ['Teknik Informatika', 'Sistem Informasi', 'Manajemen', 'Akuntansi', 'Ilmu Komunikasi'];
        
        return [
            'name' => $this->faker->name(),
            'student_id' => '0' . $this->faker->unique()->numberBetween(11000000, 19999999),
            'major' => $this->faker->randomElement($majors),
            'entry_year' => $this->faker->numberBetween(2020, 2024),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}