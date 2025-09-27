<!DOCTYPE html>
<html>
<head>
    <title>Laporan Arus Kas</title>
    <style>
        @page { margin: 0.75in; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.4;
        }
        .kop-surat {
            width: 100%;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-surat td { vertical-align: middle; }
        .kop-surat .logo { width: 80px; height: auto; }
        .kop-surat .text-kop { text-align: center; }
        .kop-surat h1 { font-size: 16pt; font-weight: bold; margin: 0; }
        .kop-surat h2 { font-size: 18pt; font-weight: bold; margin: 0; }
        .kop-surat p { font-size: 10pt; margin: 0; }

        .report-title { text-align: center; margin-bottom: 20px; }
        .report-title h3 { margin: 0; font-size: 14pt; text-decoration: underline; }
        .report-title p { margin: 0; font-size: 12pt; }

        .content-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .content-table th, .content-table td { padding: 6px 8px; }
        .content-table thead th {
            border-bottom: 1px solid black;
            border-top: 1px solid black;
            text-align: center;
        }
        .content-table .group-header { font-weight: bold; }
        .content-table .item-row td { padding-left: 25px; }
        .content-table .amount { text-align: right; }
        .content-table .subtotal td { border-top: 1px solid #888; }
        .content-table .grand-total td {
            border-top: 1px solid black;
            border-bottom: 2px double black;
            font-weight: bold;
        }

        .signature-section { margin-top: 60px; width: 100%; }
        .signature-section .signature-box {
            width: 45%;
            text-align: center;
        }
        .signature-section .left { float: left; }
        .signature-section .right { float: right; }
        .signature-section .jabatan { margin-bottom: 80px; }
        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>
<body>
    @php
        $incomeTransactions = $transactions->where('type', 'income');
        $expenseTransactions = $transactions->where('type', 'expense');
        $netChange = $totalIncome - $totalExpense;
        $endingBalance = $startingBalance + $netChange;
    @endphp

    <table class="kop-surat">
        <tr>
            <td><img src="{{ public_path('images/logo-ptq.svg') }}" alt="Logo" class="logo"></td>
            <td class="text-kop">
                <h1>UNIVERSITAS MALIKUSSALEH</h1>
                <h2>UNIT KEGIATAN MAHASISWA (UKM) PENGEMBANGAN TILAWATIL QUR'AN</h2>
                <p>Alamat Sekretariat: Jalan Kampus Unimal, Reuleut, Kab. Aceh Utara | Email: ukmptq@unimal.ac.id</p>
            </td>
        </tr>
    </table>

    <div class="report-title">
        <h3>LAPORAN ARUS KAS</h3>
        <p>Untuk Periode yang Berakhir pada {{ $endDate->locale('id')->isoFormat('D MMMM YYYY') }}</p>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th style="width: 15%;">Tanggal</th>
                <th style="text-align: left;">Keterangan</th>
                <th style="width: 25%;" class="amount">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr class="group-header">
                <td colspan="2">Saldo Awal per {{ $startDate->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                <td class="amount">{{ number_format($startingBalance, 2, ',', '.') }}</td>
            </tr>

            <!-- Arus Kas dari Aktivitas Operasi (Penerimaan) -->
            <tr class="group-header">
                <td colspan="3">Penerimaan Kas:</td>
            </tr>
            @forelse ($incomeTransactions as $tx)
                <tr class="item-row">
                    <td>{{ \Carbon\Carbon::parse($tx->transaction_date)->format('d-m-Y') }}</td>
                    <td>{{ $tx->description }} ({{ $tx->transactionCategory->name }})</td>
                    <td class="amount">{{ number_format($tx->amount, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr class="item-row"><td colspan="3">Tidak ada penerimaan kas pada periode ini.</td></tr>
            @endforelse
            <tr class="subtotal">
                <td colspan="2"><strong>Total Penerimaan Kas</strong></td>
                <td class="amount"><strong>{{ number_format($totalIncome, 2, ',', '.') }}</strong></td>
            </tr>

            <!-- Arus Kas dari Aktivitas Operasi (Pengeluaran) -->
            <tr class="group-header">
                <td colspan="3">Pengeluaran Kas:</td>
            </tr>
            @forelse ($expenseTransactions as $tx)
                <tr class="item-row">
                    <td>{{ \Carbon\Carbon::parse($tx->transaction_date)->format('d-m-Y') }}</td>
                    <td>{{ $tx->description }} ({{ $tx->transactionCategory->name }})</td>
                    <td class="amount">({{ number_format($tx->amount, 2, ',', '.') }})</td>
                </tr>
            @empty
                <tr class="item-row"><td colspan="3">Tidak ada pengeluaran kas pada periode ini.</td></tr>
            @endforelse
            <tr class="subtotal">
                <td colspan="2"><strong>Total Pengeluaran Kas</strong></td>
                <td class="amount"><strong>({{ number_format($totalExpense, 2, ',', '.') }})</strong></td>
            </tr>

            <!-- Saldo Akhir -->
            <tr class="grand-total">
                <td colspan="2">Kenaikan (Penurunan) Bersih Kas</td>
                <td class="amount">{{ number_format($netChange, 2, ',', '.') }}</td>
            </tr>
            <tr class="grand-total">
                <td colspan="2">Saldo Akhir per {{ $endDate->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                <td class="amount">{{ number_format($endingBalance, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section clearfix">
        <div class="signature-box left">
            <p>Mengetahui,</p>
            <p class="jabatan">Ketua Umum</p>
            <strong><u>(Nama Ketua Umum)</u></strong>
        </div>
        <div class="signature-box right">
            <p>Lhokseumawe, {{ now()->locale('id')->isoFormat('D MMMM YYYY') }}</p>
            <p class="jabatan">Bendahara Umum</p>
            <strong><u>(Nama Bendahara)</u></strong>
        </div>
    </div>

</body>
</html>