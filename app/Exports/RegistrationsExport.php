<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrationsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registration::select(
            'full_name', 
            'nim', 
            'faculty', 
            'department', 
            'year_in', 
            'phone_number', 
            'email', 
            'reason', 
            'status',
            'created_at'
        )->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'NIM',
            'Fakultas',
            'Jurusan',
            'Angkatan',
            'No. Telepon',
            'Email',
            'Alasan Bergabung',
            'Status',
            'Tanggal Daftar',
        ];
    }
}