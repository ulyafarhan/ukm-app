<?php

namespace App\Models;

// PASTIKAN ANDA MEMILIKI BARIS INI DENGAN BENAR
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory; // Baris ini sekarang akan berfungsi dengan benar

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'student_id',
        'major',
        'entry_year',
        'phone_number',
        'address',
        'status'
    ];
}