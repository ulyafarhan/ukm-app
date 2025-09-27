import React from 'react';
import { Head, Link } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';
import { Pagination } from '@/Components/Pagination'; // Komponen paginasi akan kita buat

export default function NewsIndex({ events }) {
    return (
        <PublicLayout>
            <Head title="Berita & Kegiatan" />

            <div className="bg-gray-50 py-20">
                <div className="container mx-auto px-6">
                    <h1 className="text-4xl font-bold text-center mb-12 text-gray-800">Berita & Kegiatan</h1>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        {events.data.map(event => (
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

                    <Pagination links={events.links} />
                </div>
            </div>
        </PublicLayout>
    );
}