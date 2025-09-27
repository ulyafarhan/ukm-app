<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page; // Pastikan ini benar

class GeneratorSurat extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = DocumentResource::class;

    protected static string $view = 'filament.resources.document-resource.pages.generator-surat';

    protected static ?string $title = 'Generator Surat';
    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?int $navigationSort = 3;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nomor_surat')->label('Nomor Surat')->required(),
                TextInput::make('perihal')->label('Perihal')->required(),
                TextInput::make('lampiran')->label('Lampiran')->default('-'),
                Textarea::make('isi_surat')->label('Isi Surat')->rows(6)->required()
                    ->hint('Tulis isi utama surat di sini.'),
                DatePicker::make('tanggal_surat')->label('Tanggal Surat')->default(now())->required(),
                TextInput::make('penanggung_jawab')->label('Penanggung Jawab')->required(),
                TextInput::make('jabatan')->label('Jabatan Penanggung Jawab')->required(),
            ])
            ->statePath('data');
    }

    public function generateSurat()
    {
        $data = $this->form->getState();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('templates.surat-resmi', $data);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'Surat-' . str_replace('/', '_', $data['nomor_surat']) . '.pdf'
        );
    }
}