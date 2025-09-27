<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentCategory;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Proposal Kegiatan'],
            ['name' => 'Laporan Pertanggungjawaban'],
            ['name' => 'Surat Masuk'],
            ['name' => 'Surat Keluar'],
        ];

        foreach ($categories as $category) {
            DocumentCategory::create($category);
        }

        Document::factory(25)->create();
    }
}