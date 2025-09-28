<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Member;

class MemberPageController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk anggota.
     */
    public function dashboard()
    {
        // TODO: Tambahkan data agregat untuk dashboard anggota jika diperlukan.
        // Contoh: jumlah acara mendatang, saldo kas terakhir, dll.
        return Inertia::render('member/dashboard');
    }

    /**
     * Menampilkan daftar anggota.
     */
    public function index()
    {
        // Ambil data anggota dari database, urutkan berdasarkan nama.
        // Gunakan paginasi agar halaman tidak lambat saat data banyak.
        $members = Member::orderBy('name')->paginate(20)->through(fn ($member) => [
            'id' => $member->id,
            'student_id' => $member->student_id,
            'name' => $member->name,
            'major' => $member->major,
            'entry_year' => $member->entry_year,
        ]);

        return Inertia::render('member/members/index', ['members' => $members]);
    }
}