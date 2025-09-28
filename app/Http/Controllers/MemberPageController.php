<?php

// Namespace ini sudah benar sesuai struktur awal Anda
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
// Tambahkan baris ini untuk memanggil Controller utama
use App\Http\Controllers\Controller;

class MemberPageController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk anggota.
     */
    public function dashboard()
    {
        // Pastikan nama komponen React/Vue Anda adalah 'member/Dashboard'
        return Inertia::render('member/Dashboard');
    }

    /**
     * Menampilkan daftar anggota.
     */
    public function index()
    {
        // Pastikan nama komponen React/Vue Anda adalah 'member/members/Index'
        return Inertia::render('member/members/Index');
    }
}