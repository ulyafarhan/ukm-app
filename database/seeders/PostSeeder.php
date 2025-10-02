<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::first();

        if (!$author) {
            $this->command->warn('Tidak ada user di database. Silakan jalankan UserSeeder terlebih dahulu.');
            return;
        }

        for ($i = 0; $i < 15; $i++) {
            $title = fake()->unique()->sentence(rand(5, 10));

            Post::create([
                'user_id' => $author->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => fake()->paragraphs(10, true),
                'thumbnail' => null, // Anda bisa ganti dengan URL gambar jika ada
                'published_at' => now(),
            ]);
        }
    }
}