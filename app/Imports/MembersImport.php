<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Member([
            'name'         => $row['nama_lengkap'],
            'student_id'   => $row['nim'],
            'major'        => $row['jurusan'],
            'entry_year'   => $row['angkatan'],
            'phone_number' => $row['nomor_hp'],
            'address'      => $row['alamat'],
            'status'       => 'active',
        ]);
    }
}