<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class MemberDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.member-dashboard';
    protected static ?string $title = 'Dasbor Anggota';

    // Sembunyikan dari navigasi utama karena ini akan jadi halaman default
    protected static bool $shouldRegisterNavigation = false;

    public $user;
    public $upcomingEvents;

    public function mount(): void
    {
        $this->user = Auth::user();

        // Ambil event yang akan datang
        $this->upcomingEvents = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();
    }
}
