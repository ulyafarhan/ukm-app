<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// --- TAMBAHKAN USE STATEMENTS DI BAWAH INI ---
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationGroup = 'Administrasi';
    protected static ?string $label = 'Dokumen';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('document_category_id')
                    ->relationship('documentCategory', 'name')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('file_path')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('documentCategory.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            // --- UBAH HEADER ACTIONS MENJADI DROPDOWN ---
            ->headerActions([
                ActionGroup::make([
                     Action::make('Generator Surat')
                        ->icon('heroicon-o-document-plus')
                        ->url(fn (): string => route('filament.admin.resources.documents.generator-surat')),
                ])
                ->button()
                ->label('Aksi')
                ->icon('heroicon-o-ellipsis-vertical'),
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
            'generator-surat' => Pages\GeneratorSurat::route('/generator-surat'),
        ];
    }
}