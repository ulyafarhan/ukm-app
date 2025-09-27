import React from 'react';
import { Link } from '@inertiajs/react';

export default function PublicLayout({ children }) {
    return (
        <div className="font-sans text-gray-900 antialiased">
            <header className="bg-white shadow-md sticky top-0 z-50">
                <div className="container mx-auto px-6 py-4 flex justify-between items-center">
                    <div className="text-xl font-bold text-gray-800">
                        <Link href={route('home')}>UKM PTQ UNIMAL</Link>
                    </div>
                    <nav className="hidden md:flex space-x-8">
                        <Link href={route('home')} className="text-gray-600 hover:text-amber-600">Beranda</Link>
                        <Link href={route('news.index')} className="text-gray-600 hover:text-amber-600">Berita</Link>
                        {/* Tambahkan link lain di sini */}
                    </nav>
                    <div>
                         <Link href={route('login')} className="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                            Login Anggota
                        </Link>
                    </div>
                </div>
            </header>

            <main>{children}</main>

            <footer className="bg-gray-800 text-white">
                <div className="container mx-auto px-6 py-8">
                    <div className="text-center">
                        <h3 className="text-2xl font-bold">UKM PTQ UNIMAL</h3>
                        <p className="mt-2">Mengabdi, Berkarya, Menginspirasi.</p>
                        <div className="mt-4">
                            {/* Tambahkan link sosial media di sini */}
                        </div>
                    </div>
                    <div className="mt-8 border-t border-gray-700 pt-4 text-center text-sm text-gray-400">
                        <p>&copy; {new Date().getFullYear()} UKM PTQ Unimal. All Rights Reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    );
}