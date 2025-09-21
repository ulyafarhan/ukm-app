<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        // Pisahkan antara kegiatan yang akan datang dan yang sudah lewat
        $upcomingEvents = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();

        $pastEvents = Event::where('start_date', '<', now())
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return Inertia::render('member/events/index', [
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents,
        ]);
    }
}