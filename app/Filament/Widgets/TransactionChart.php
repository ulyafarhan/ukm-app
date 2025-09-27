<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Transaksi 6 Bulan Terakhir';
    
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Transaction::selectRaw('strftime(\'%Y-%m\', transaction_date) as month, type, SUM(amount) as total')
            ->where('transaction_date', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month', 'type')
            ->orderBy('month', 'asc')
            ->get();

        $months = collect([]);
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i)->format('Y-m'));
        }

        $incomeData = [];
        $expenseData = [];

        foreach ($months as $month) {
            $incomeData[] = $data->where('month', $month)->where('type', 'income')->first()->total ?? 0;
            $expenseData[] = $data->where('month', $month)->where('type', 'expense')->first()->total ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $incomeData,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgb(75, 192, 192)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $expenseData,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $months->map(fn($month) => Carbon::createFromFormat('Y-m', $month)->format('M Y')),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}