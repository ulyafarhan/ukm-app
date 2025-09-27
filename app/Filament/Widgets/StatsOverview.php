<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Member;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');

        return [
            Stat::make('Total Anggota', Member::count())
                ->description('Jumlah anggota aktif dan non-aktif')
                ->icon('heroicon-o-users'),
            Stat::make('Total Acara', Event::count())
                ->description('Jumlah acara yang telah dan akan datang')
                ->icon('heroicon-o-calendar'),
            Stat::make('Total Pemasukan', 'Rp ' . number_format($totalIncome, 0, ',', '.'))
                ->description('Akumulasi dari semua pemasukan')
                ->icon('heroicon-o-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalExpense, 0, ',', '.'))
                ->description('Akumulasi dari semua pengeluaran')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('danger'),
        ];
    }
}