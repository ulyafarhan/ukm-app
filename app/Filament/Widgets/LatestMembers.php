<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\MemberResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestMembers extends BaseWidget
{
    protected static ?string $heading = 'Anggota Baru';
    
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(MemberResource::getEloquentQuery()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama'),
                Tables\Columns\TextColumn::make('major')->label('Jurusan'),
                Tables\Columns\TextColumn::make('entry_year')->label('Angkatan'),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Daftar')->since(),
            ]);
    }
}