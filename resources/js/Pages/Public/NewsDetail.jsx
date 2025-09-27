import React from 'react';
import { Head } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';

export default function NewsDetail({ event }) {
    return (
        <PublicLayout>
            <Head title={event.title} />

            <div className="container mx-auto px-6 py-20">
                <article className="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8 md:p-12">
                    <img className="w-full h-96 object-cover rounded-lg mb-8" src={`/images/event-placeholder.jpg`} alt={event.title} />
                    <p className="text-gray-500 mb-2">
                        Dipublikasikan pada {new Date(event.date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}
                    </p>
                    <h1 className="text-4xl font-bold text-gray-900 mb-6">{event.title}</h1>
                    <div className="prose max-w-none text-gray-700">
                        <p>{event.description}</p>
                    </div>
                </article>
            </div>
        </PublicLayout>
    );
}