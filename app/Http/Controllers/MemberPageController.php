<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class MemberPageController extends Controller
{
    public function dashboard()
    {
        // Gunakan huruf kecil untuk menghindari masalah case-sensitivity
        return Inertia::render('member/dashboard');
    }

    public function index()
    {
        $members = User::whereHas('roles', function ($query) {
            $query->where('name', 'member');
        })
            ->latest()
            ->paginate(10)
            ->through(fn ($member) => [
                'id' => $member->id,
                'name' => $member->name,
                'email' => $member->email,
                'joined_at' => $member->created_at->diffForHumans(),
            ]);

        return Inertia::render('member/members/index', [
            'members' => $members,
        ]);
    }
}