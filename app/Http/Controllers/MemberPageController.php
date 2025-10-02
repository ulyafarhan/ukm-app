<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use App\Models\User;
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

        $latestTransactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get(['id', 'description', 'amount', 'type', 'transaction_date']);

        $duesStatus = Transaction::where('user_id', $user->id)
            ->where('transaction_category_id', 1) 
            ->whereYear('transaction_date', now()->year)
            ->whereMonth('transaction_date', now()->month)
            ->exists();

        $stats = [
            'membershipStatus' => 'Aktif',
            'eventsAttended' => 0, 
            'activityPoints' => 0, 
            'duesStatus' => $duesStatus ? 'Lunas' : 'Belum Lunas',
        ];


        return Inertia::render('member/dashboard', [
            'dashboardData' => [
                'stats' => $stats,
                'upcomingEvents' => $upcomingEvents,
                'latestTransactions' => $latestTransactions,
            ]
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