<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationPeriodResource\Pages;
use App\Models\RegistrationPeriod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RegistrationPeriodResource extends Resource
{
    protected static ?string $model = RegistrationPeriod::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Pendaftaran';
    protected static ?string $label = 'Periode Pendaftaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Periode')
                    ->required(),
                Forms\Components\DateTimePicker::make('start_date')
                    ->label('Tanggal Dibuka')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_date')
                    ->label('Tanggal Ditutup')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktifkan Periode Ini')
                    ->helperText('Hanya satu periode yang bisa aktif dalam satu waktu.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Periode')->searchable(),
                Tables\Columns\TextColumn::make('start_date')->label('Dibuka')->dateTime(),
                Tables\Columns\TextColumn::make('end_date')->label('Ditutup')->dateTime(),
                Tables\Columns\IconColumn::make('is_active')->label('Status')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistrationPeriods::route('/'),
            'create' => Pages\CreateRegistrationPeriod::route('/create'),
            'edit' => Pages\EditRegistrationPeriod::route('/{record}/edit'),
        ];
    }
}