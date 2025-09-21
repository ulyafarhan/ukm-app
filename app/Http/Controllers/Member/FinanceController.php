<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FinanceController extends Controller
{
    /**
     * Menampilkan halaman riwayat keuangan.
     */
    public function index(Request $request): Response
    {
        // 1. Ambil semua transaksi, relasikan dengan kategori dan user
        // Urutkan dari yang paling baru
        $transactions = Transaction::with(['category', 'user'])
            ->latest('transaction_date')
            ->latest('id')
            ->paginate(15); // Gunakan paginasi agar tidak berat

        // 2. Hitung statistik untuk ringkasan
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalOutcome = Transaction::where('type', 'outcome')->sum('amount');
        $finalBalance = $totalIncome - $totalOutcome;

        // 3. Kirim data ke view Inertia
        return Inertia::render('member/finance/index', [
            'transactions' => $transactions,
            'stats' => [
                'totalIncome' => (float) $totalIncome,
                'totalOutcome' => (float) $totalOutcome,
                'finalBalance' => (float) $finalBalance,
            ],
        ]);
    }
}