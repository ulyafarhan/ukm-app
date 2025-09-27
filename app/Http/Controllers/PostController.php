<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Menampilkan halaman daftar semua berita (blog index).
     */
    public function index()
    {
        $posts = Post::query()
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(9)
            ->through(fn ($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'thumbnail_url' => $post->thumbnail,
                'published_at' => $post->published_at,
            ]);

        return Inertia::render('Public/BlogIndex', [
            'posts' => $posts,
        ]);
    }

    /**
     * Menampilkan halaman detail satu berita.
     */
    public function show(Post $post)
    {
        // Pastikan post sudah dipublikasikan
        abort_if(is_null($post->published_at), 404);

        return Inertia::render('Public/BlogDetail', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'thumbnail_url' => $post->thumbnail,
                'author' => $post->user->name,
                'published_at' => $post->published_at,
            ]
        ]);
    }
}