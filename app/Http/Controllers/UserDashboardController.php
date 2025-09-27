<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Support\Carbon;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Ambil 5 acara terdekat yang akan datang
        $upcomingEvents = Event::where('date', '>=', Carbon::now())
            ->orderBy('date', 'asc')
            ->limit(5)
            ->get();

        return Inertia::render('Dashboard', [
            'stats' => [
                'totalMembers' => Member::count(),
                'totalEvents' => Event::count(),
                'upcomingEventsCount' => $upcomingEvents->count(),
            ],
            'upcomingEvents' => $upcomingEvents,
        ]);
    }
}