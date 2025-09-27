<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicPageController extends Controller
{
    public function home()
    {
        // Mengambil 3 event/berita terbaru untuk ditampilkan di halaman utama
        $latestEvents = Event::latest()->take(3)->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'image_url' => $event->image,
                'created_at' => $event->created_at,
            ];
        });

        return Inertia::render('Public/Home', [
            'events' => $latestEvents
        ]);
    }

    public function news()
    {
        $events = Event::latest()->paginate(9)->through(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'content' => $event->content,
                'image_url' => $event->image,
                'created_at' => $event->created_at,
            ];
        });
        return Inertia::render('Public/NewsIndex', [
            'events' => $events
        ]);
    }

    public function newsDetail(Event $event)
    {
        return Inertia::render('Public/NewsDetail', [
            'event' => [
                'id' => $event->id,
                'title' => $event->title,
                'content' => $event->content,
                'image_url' => $event->image,
                'created_at' => $event->created_at,
            ]
        ]);
    }
}