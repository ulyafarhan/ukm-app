<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $modelLabel = 'Transaksi Kas';
    protected static ?string $pluralModelLabel = 'Transaksi Kas UKM';
    protected static ?string $navigationGroup = 'Manajemen Keuangan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('transaction_category_id')->label('Kategori Transaksi')
                    ->relationship('transactionCategory', 'name')
                    ->required(),
                Forms\Components\TextInput::make('amount')->label('Jumlah Uang')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\DatePicker::make('transaction_date')->label('Tanggal Transaksi')
                    ->required(),
                Forms\Components\Radio::make('type')->label('Tipe')
                    ->options([
                        'income' => 'Pemasukan',
                        'expense' => 'Pengeluaran',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('description')->label('Deskripsi')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('receipt_path')->label('Bukti Transaksi (Opsional)')
                    ->directory('receipts')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transactionCategory.name')->label('Kategori')->sortable(),
                Tables\Columns\TextColumn::make('amount')->label('Jumlah')->money('IDR')->sortable(),
                Tables\Columns\TextColumn::make('transaction_date')->label('Tanggal')->date()->sortable(),
                Tables\Columns\TextColumn::make('type')->label('Tipe')->badge()->color(fn (string $state): string => match ($state) {
                    'income' => 'success',
                    'expense' => 'danger',
                })->formatStateUsing(fn (string $state): string => match ($state) {
                    'income' => 'Pemasukan',
                    'expense' => 'Pengeluaran',
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
            'laporan' => Pages\LaporanTransaksi::route('/laporan'),
        ];
    }    
}