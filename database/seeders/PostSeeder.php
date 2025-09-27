<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama yang ada di database untuk dijadikan penulis
        $user = User::first();

        // Jika tidak ada user, buat satu user baru
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin PTQ',
                'email' => 'admin@ptq.com',
            ]);
        }

        // Buat 15 berita contoh
        for ($i = 0; $i < 15; $i++) {
            $title = fake()->sentence(6);
            Post::create([
                'user_id' => $user->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => '<p>' . implode('</p><p>', fake()->paragraphs(10)) . '</p>',
                'published_at' => now()->subDays($i),
            ]);
        }
    }
}