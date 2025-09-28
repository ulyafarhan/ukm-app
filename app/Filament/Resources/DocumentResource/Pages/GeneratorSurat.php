<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Resources\Pages\Page;
use App\Models\Member;
use Illuminate\Support\Facades\Blade;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class GeneratorSurat extends Page
{
    protected static string $resource = DocumentResource::class;
    protected static string $view = 'filament.resources.document-resource.pages.generator-surat';

    public $members;
    public $data = [
        'member_id' => null,
        'nomor_surat' => '',
        'perihal' => '',
        'lampiran' => '',
    ];

    protected function rules(): array
    {
        return [
            'data.member_id' => 'required|exists:members,id',
            'data.nomor_surat' => 'required|string|max:255',
            'data.perihal' => 'required|string|max:255',
        ];
    }

    protected function getMessages(): array
    {
        return [
            'data.member_id.required' => 'Anggota wajib dipilih.',
            'data.nomor_surat.required' => 'Nomor surat wajib diisi.',
            'data.perihal.required' => 'Perihal wajib diisi.',
        ];
    }


    public function mount(): void
    {
        $this->members = Member::all();
    }

    public function generate()
    {
        $this->validate();

        $member = Member::find($this->data['member_id']);

        $data = [
            'nama' => $member->nama,
            'nim' => $member->nim,
            'prodi' => $member->prodi,
            'nomor_surat' => $this->data['nomor_surat'],
            'perihal' => $this->data['perihal'],
            'lampiran' => $this->data['lampiran'] ?? '-',
            'tanggal' => now()->translatedFormat('d F Y'),
        ];
        
        $content = Blade::render(file_get_contents(resource_path('views/templates/surat-resmi.blade.php')), $data);
        
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $content, false, false);
        
        $filename = 'surat_' . str_replace(' ', '_', $member->nama) . '.docx';

        $headers = [
            "Content-Type" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "Content-Disposition" => "attachment; filename={$filename}",
        ];

        return response()->streamDownload(function() use ($phpWord) {
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save('php://output');
        }, $filename, $headers);
    }
}