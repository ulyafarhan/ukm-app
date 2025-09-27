<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page; // <-- Pastikan ini benar
use Illuminate\Support\Carbon;

class LaporanTransaksi extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = TransactionResource::class;

    protected static string $view = 'filament.resources.transaction-resource.pages.laporan-transaksi';

    // Properti di bawah ini yang akan membuat sub-menu
    protected static ?string $title = 'Laporan Transaksi';
    protected static ?string $navigationIcon = 'heroicon-o-printer';
    protected static ?int $navigationSort = 3;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'tanggal_mulai' => now()->startOfMonth(),
            'tanggal_selesai' => now()->endOfMonth(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tanggal_mulai')->label('Tanggal Mulai')->required(),
                DatePicker::make('tanggal_selesai')->label('Tanggal Selesai')->required(),
            ])
            ->statePath('data');
    }

    public function cetakLaporan()
    {
        $data = $this->form->getState();
        $startDate = Carbon::parse($data['tanggal_mulai']);
        $endDate = Carbon::parse($data['tanggal_selesai']);

        // Hitung Saldo Awal
        $incomeBefore = Transaction::where('type', 'income')->where('transaction_date', '<', $startDate)->sum('amount');
        $expenseBefore = Transaction::where('type', 'expense')->where('transaction_date', '<', $startDate)->sum('amount');
        $startingBalance = $incomeBefore - $expenseBefore;

        // Ambil transaksi pada periode yang dipilih
        $transactions = Transaction::with('transactionCategory')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->orderBy('transaction_date', 'asc')
            ->get();
            
        // Hitung total pada periode berjalan
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('reports.financial', [
            'startingBalance' => $startingBalance,
            'transactions' => $transactions,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'Laporan-Keuangan-' . $startDate->format('d-m-Y') . '-' . $endDate->format('d-m-Y') . '.pdf'
        );
    }
}