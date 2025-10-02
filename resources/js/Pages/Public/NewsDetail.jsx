import React from 'react';
import { Head, Link } from '@inertiajs/react';
import PublicLayout from './PublicLayout';

export default function NewsDetail({ post }) { // Diubah dari event menjadi post

    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    };

    return (
        <PublicLayout auth={post.auth}>
            <Head title={post.title} />

            <div className="py-12 bg-white">
                <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                    <article className="max-w-4xl mx-auto">
                        <div className="mb-8">
                             <Link href={route('news.index')} className="text-indigo-600 hover:text-indigo-800 font-semibold">
                                &larr; Kembali ke Semua Berita
                            </Link>
                        </div>
                        <img 
                            src={post.image_url} 
                            alt={post.title}
                            className="w-full h-auto max-h-[400px] object-cover rounded-lg mb-6"
                        />
                        <h1 className="text-4xl font-bold text-gray-900 mb-4">{post.title}</h1>
                        <p className="text-gray-500 mb-6">{formatDate(post.created_at)}</p>
                        <div 
                            className="prose max-w-none"
                            dangerouslySetInnerHTML={{ __html: post.content }}
                        />
                    </article>
                </div>
            </div>
        </PublicLayout>
    );
}