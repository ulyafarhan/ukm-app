<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneratorSurat extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = DocumentResource::class;

    protected static string $view = 'filament.resources.document-resource.pages.generator-surat';

    public $nomor_surat;
    public $perihal;
    public $penerima;
    public $tujuan_surat;
    public $isi_surat;
    public $lampiran = '-'; 
    public $jabatan;
    public $penanggung_jawab;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\TextInput::make('nomor_surat')
                        ->label('Nomor Surat')
                        ->required(),
                    Forms\Components\TextInput::make('lampiran')
                        ->label('Lampiran')
                        ->default('-')
                        ->placeholder('Contoh: 1 Berkas'),
                    Forms\Components\TextInput::make('perihal')
                        ->label('Perihal')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('penerima')
                        ->label('Penerima Surat')
                        ->required(),
                    Forms\Components\TextInput::make('tujuan_surat')
                        ->label('Tujuan / Tempat')
                        ->placeholder('Contoh: Tempat')
                        ->required(),
                    Forms\Components\RichEditor::make('isi_surat')
                        ->label('Isi Surat')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('jabatan')
                        ->label('Jabatan Penandatangan')
                        ->placeholder('Contoh: Ketua Umum')
                        ->required(),
                    Forms\Components\TextInput::make('penanggung_jawab')
                        ->label('Nama Penandatangan')
                        ->placeholder('Contoh: nama lengkap dengan gelar')
                        ->required(),
                ])
        ];
    }

    public function generateSurat()
    {
        $data = $this->form->getState();

        $data['tanggal_surat'] = now()->translatedFormat('d F Y');

        $pdf = Pdf::loadView('templates.surat-resmi', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'surat-resmi.pdf');
    }
}