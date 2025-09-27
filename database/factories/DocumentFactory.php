<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DocumentCategory;

class DocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'document_category_id' => DocumentCategory::inRandomOrder()->first()->id,
            'file_path' => 'documents/dummy.pdf',
            'description' => $this->faker->paragraph(2),
        ];
    }
}