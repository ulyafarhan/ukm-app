<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PublicPageController extends Controller
{
    /**
     * Data dasar yang dibutuhkan di semua halaman publik.
     */
    private function getBaseProps(): array
    {
        return [
            'auth' => [
                'user' => auth()->user(),
            ],
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ];
    }

    /**
     * Menampilkan halaman utama (Home).
     */
    public function home()
    {
        $latestEvents = Event::latest('date')->limit(3)->get();
        $memberCount = Member::where('status', 'active')->count();

        return Inertia::render('Public/Home', array_merge($this->getBaseProps(), [
            'latestEvents' => $latestEvents,
            'memberCount' => $memberCount,
        ]));
    }

    /**
     * Menampilkan daftar semua berita/kegiatan.
     */
    public function news()
    {
        $allEvents = Event::latest('date')->paginate(9);

        return Inertia::render('Public/NewsIndex', array_merge($this->getBaseProps(), [
            'events' => $allEvents,
        ]));
    }

    /**
     * Menampilkan detail satu berita/kegiatan.
     */
    public function newsDetail(Event $event)
    {
        return Inertia::render('Public/NewsDetail', array_merge($this->getBaseProps(), [
            'event' => $event,
        ]));
    }
}