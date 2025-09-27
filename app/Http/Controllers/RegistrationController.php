<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\RegistrationPeriod;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function create()
    {
        $activePeriod = RegistrationPeriod::where('is_active', true)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();

        return Inertia::render('Public/RegisterMember', [
            'isOpen' => (bool)$activePeriod,
            'periodName' => $activePeriod->name ?? 'Pendaftaran Anggota Baru',
        ]);
    }

    public function store(Request $request)
    {
        $activePeriod = RegistrationPeriod::where('is_active', true)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();

        if (!$activePeriod) {
            return back()->with('error', 'Pendaftaran saat ini sedang ditutup.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:registrations',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'year_in' => 'required|integer|min:2000',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:registrations',
            'reason' => 'required|string',
        ]);

        Registration::create($validated);

        return redirect()->route('register.member.create')->with('success', 'Pendaftaran berhasil! Terima kasih telah mendaftar.');
    }
}