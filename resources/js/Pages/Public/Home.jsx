import React from 'react';
import { Head, Link } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';

export default function Home({ latestEvents, memberCount }) {
    return (
        <PublicLayout>
            <Head title="Selamat Datang" />

            {/* Hero Section */}
            <section className="relative h-[600px] flex items-center justify-center text-center text-white bg-cover bg-center" style={{ backgroundImage: "url('/images/hero-background.jpg')" }}>
                <div className="absolute inset-0 bg-black opacity-50"></div>
                <div className="relative z-10 p-4">
                    <h1 className="text-4xl md:text-6xl font-extrabold leading-tight mb-4 animate-fade-in-down">
                        Mengabdi, Berkarya, Menginspirasi
                    </h1>
                    <p className="text-lg md:text-xl max-w-2xl mx-auto mb-8 animate-fade-in-up">
                        UKM PTQ Unimal adalah wadah bagi mahasiswa untuk mengembangkan potensi dalam seni baca Al-Qur'an dan syiar Islam di lingkungan kampus.
                    </p>
                    <Link href={route('news.index')} className="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                        Lihat Kegiatan Kami
                    </Link>
                </div>
            </section>

            {/* Latest News/Events Section */}
            <section className="py-20 bg-gray-50">
                <div className="container mx-auto px-6">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl font-bold text-gray-800">Kegiatan Terbaru</h2>
                        <p className="text-gray-600 mt-2">Ikuti perkembangan dan aktivitas terbaru dari kami.</p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {latestEvents.map(event => (
                            <div key={event.id} className="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                                <img className="w-full h-56 object-cover" src={`/images/event-placeholder.jpg`} alt={event.title} />
                                <div className="p-6">
                                    <p className="text-sm text-gray-500 mb-2">{new Date(event.date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                                    <h3 className="text-xl font-bold mb-3 text-gray-800">{event.title}</h3>
                                    <p className="text-gray-600 line-clamp-3 mb-4">{event.description}</p>
                                    <Link href={route('news.detail', event.id)} className="font-semibold text-amber-600 hover:text-amber-700">
                                        Baca Selengkapnya &rarr;
                                    </Link>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

        </PublicLayout>
    );
}