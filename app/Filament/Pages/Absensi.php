<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Absensi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static string $view = 'filament.pages.absensi';

    /**
     * Hanya pengguna dengan role 'member' yang bisa melihat menu ini.
     */
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('member');
    }
}