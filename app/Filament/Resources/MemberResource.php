<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Imports\MembersImport; // Pastikan ini di-import
use pxlrbt\FilamentExcel\Actions\Tables\ImportAction; // Pastikan ini di-import

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Anggota';
    protected static ?string $pluralModelLabel = 'Anggota';
    protected static ?string $navigationGroup = 'Manajemen Anggota';

    /**
     * Hanya admin yang bisa melihat menu ini.
     */
    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Nama Lengkap')->required(),
            Forms\Components\TextInput::make('student_id')->label('NIM')->required(),
            Forms\Components\TextInput::make('major')->label('Jurusan')->required(),
            Forms\Components\TextInput::make('entry_year')->label('Tahun Angkatan')->numeric()->required(),
            Forms\Components\TextInput::make('phone_number')->label('Nomor HP')->tel(),
            Forms\Components\Textarea::make('address')->label('Alamat')->columnSpanFull(),
            Forms\Components\Select::make('status')->options(['active' => 'Aktif', 'inactive' => 'Tidak Aktif'])->required()->default('active'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('student_id')->label('NIM'),
                Tables\Columns\TextColumn::make('major')->label('Jurusan'),
                Tables\Columns\TextColumn::make('entry_year')->label('Angkatan'),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'active' => 'success',
                    'inactive' => 'danger',
                })->formatStateUsing(fn (string $state): string => ($state == 'active') ? 'Aktif' : 'Tidak Aktif'),
            ])
            ->filters([
                // filter bisa ditambahkan di sini
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            // LETAKKAN TOMBOL IMPORT DI SINI
            ->headerActions([
                ImportAction::make()
                    ->label('Import Anggota')
                    ->use(MembersImport::class)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}