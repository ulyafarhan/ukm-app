<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\RegistrationPeriod;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Registration;

class PublicPageController extends Controller
{
    public function home()
    {
        $latestPosts = Post::latest()->take(3)->get()->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'image_url' => $post->image,
                'created_at' => $post->created_at,
            ];
        });

        return Inertia::render('Public/Home', [
            'posts' => $latestPosts
        ]);
    }

    public function newsIndex()
    {
        $posts = Post::latest()->paginate(9)->through(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => str()->limit(strip_tags($post->content), 150),
                'image_url' => $post->image,
                'created_at' => $post->created_at,
            ];
        });
        return Inertia::render('Public/NewsIndex', [
            'posts' => $posts
        ]);
    }

    public function newsDetail(Post $post)
    {
        return Inertia::render('Public/NewsDetail', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'image_url' => $post->image,
                'created_at' => $post->created_at,
            ]
        ]);
    }
    
    public function registerMember()
    {
        $activePeriod = RegistrationPeriod::where('status', 'active')->first();

        return Inertia::render('Public/RegisterMember', [
            'activePeriod' => $activePeriod,
            'registration_count' => $activePeriod ? $activePeriod->registrations()->count() : 0,
        ]);
    }

    public function storeRegisterMember(Request $request)
    {
        $activePeriod = RegistrationPeriod::where('status', 'active')->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:registrations,email,NULL,id,registration_period_id,'.$activePeriod->id,
            'phone_number' => 'required|string|max:15',
            'university' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'reason' => 'required|string|max:2000',
        ]);

        $activePeriod->registrations()->create($request->all());

        return to_route('register.member')->with('success', 'Pendaftaran Anda berhasil dikirim! Terima kasih.');
    }
}