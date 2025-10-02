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
        $activePeriod = RegistrationPeriod::where('status', 'active')
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
        $activePeriod = RegistrationPeriod::where('status', 'active')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->firstOrFail();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:registrations,nim,NULL,id,registration_period_id,'.$activePeriod->id,
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'year_in' => 'required|digits:4|integer|min:1990',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:registrations,email,NULL,id,registration_period_id,'.$activePeriod->id,
            'reason' => 'nullable|string|max:2000',
        ]);

        $activePeriod->registrations()->create($validated);

        return to_route('register.member')->with('success', 'Pendaftaran Anda berhasil dikirim!');
    }
}