<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Support\Carbon;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil 3 acara terdekat yang akan datang
        $upcomingEvents = Event::where('date', '>=', Carbon::now())
            ->orderBy('date', 'asc')
            ->limit(3)
            ->get();
            
        // Hitung total anggota
        $memberCount = Member::count();

        return Inertia::render('LandingPage', [
            'upcomingEvents' => $upcomingEvents,
            'memberCount' => $memberCount,
        ]);
    }
}