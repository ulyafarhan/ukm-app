<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Portfolio extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.pages.portfolio';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('member');
    }
}