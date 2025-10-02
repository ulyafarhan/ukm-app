<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MemberPageController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $upcomingEvents = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get(['id', 'title', 'start_date', 'location']);

        $duesStatus = Transaction::where('user_id', $user->id)
            ->where('transaction_category_id', 1) // Asumsi ID 1 adalah "Iuran Wajib"
            ->whereYear('transaction_date', now()->year)
            ->whereMonth('transaction_date', now()->month)
            ->exists();

        return Inertia::render('member/dashboard', [
            'stats' => [
                'membershipStatus' => 'Aktif',
                'duesStatus' => $duesStatus ? 'Lunas' : 'Belum Lunas',
                'eventsAttended' => 0, // Logika presensi belum ada
                'activityPoints' => 0, // Logika poin belum ada
            ],
            'upcomingEvents' => $upcomingEvents,
        ]);
    }

    public function memberIndex()
    {
        $members = User::role('member')
            ->latest()
            ->paginate(15)
            ->through(fn ($member) => [
                'id' => $member->id,
                'name' => $member->name,
                'email' => $member->email,
                'joined' => $member->created_at->format('d M Y'),
            ]);
            
        return Inertia::render('member/members/index', [
            'members' => $members
        ]);
    }
}