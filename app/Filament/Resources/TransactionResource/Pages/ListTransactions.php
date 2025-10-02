<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('laporanKeuangan')
                ->label('Cetak Laporan')
                ->url(LaporanTransaksi::getUrl())
                ->icon('heroicon-o-printer'),

            Actions\CreateAction::make(),
        ];
    }
}
