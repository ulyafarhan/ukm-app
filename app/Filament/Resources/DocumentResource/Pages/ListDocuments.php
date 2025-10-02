<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('generatorSurat')
                ->label('Buat Surat Resmi')
                ->url(GeneratorSurat::getUrl())
                ->icon('heroicon-o-document-plus'),

            Actions\CreateAction::make(),
        ];
    }
}
