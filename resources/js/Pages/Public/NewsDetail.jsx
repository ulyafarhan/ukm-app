import React from 'react';
import { Head, Link } from '@inertiajs/react';
import PublicLayout from './PublicLayout';

export default function NewsDetail({ event }) {

    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    };

    return (
        <PublicLayout auth={event.auth}>
            <Head title={event.title} />

            <div className="py-12 bg-white">
                <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                    <article className="max-w-4xl mx-auto">
                        <div className="mb-8">
                             <Link href={route('news.index')} className="text-indigo-600 hover:text-indigo-800 font-semibold">
                                &larr; Kembali ke Berita
                            </Link>
                        </div>
                        <h1 className="text-4xl font-extrabold text-gray-900 mb-4">{event.title}</h1>
                        <p className="text-gray-500 mb-6">{formatDate(event.created_at)}</p>

                        <img
                            className="w-full h-auto max-h-[500px] object-cover rounded-lg mb-8 shadow-lg"
                            src={event.image_url || `https://placehold.co/1200x600/0f766e/FFFFFF?text=UKM+Event`}
                            alt={event.title}
                        />

                        <div
                            className="prose prose-lg max-w-none"
                            dangerouslySetInnerHTML={{ __html: event.content }}
                        />
                    </article>
                </div>
            </div>
        </PublicLayout>
    );
}