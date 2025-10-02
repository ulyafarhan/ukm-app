<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Menampilkan halaman daftar postingan blog.
     */
    public function index()
    {
        $posts = Post::latest('published_at')->paginate(9)->through(fn ($post) => [
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'content' => str()->limit(strip_tags($post->content), 150),
            'thumbnail_url' => $post->thumbnail,
            'published_at' => $post->published_at->format('d M Y'),
        ]);

        return Inertia::render('Public/BlogIndex', [
            'posts' => $posts,
        ]);
    }

    /**
     * Menampilkan halaman detail postingan blog.
     */
    public function show(Post $post)
    {
        return Inertia::render('Public/BlogDetail', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'thumbnail_url' => $post->thumbnail,
                'published_at' => $post->published_at->format('d M Y'),
            ]
        ]);
    }
}