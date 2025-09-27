import React from 'react';
import { Head, Link } from '@inertiajs/react';
import PublicLayout from './PublicLayout';

export default function BlogDetail({ post }) {

    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    };

    return (
        <PublicLayout>
            <Head title={post.title} />

            <div className="py-20 bg-white">
                <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                    <article className="max-w-4xl mx-auto">
                        <div className="mb-8">
                             <Link href={route('blog.index')} className="text-indigo-600 hover:text-indigo-800 font-semibold">
                                &larr; Kembali ke Semua Berita
                            </Link>
                        </div>
                        <h1 className="text-4xl font-extrabold text-gray-900 mb-4">{post.title}</h1>
                        <p className="text-gray-500 mb-6">
                            Oleh: <span className="font-semibold">{post.author}</span> • Dipublikasikan pada {formatDate(post.published_at)}
                        </p>

                        <img
                            className="w-full h-auto max-h-[500px] object-cover rounded-lg mb-8 shadow-lg"
                            src={post.thumbnail_url || `https://placehold.co/1200x600/0f766e/FFFFFF?text=Berita`}
                            alt={post.title}
                        />

                        <div
                            className="prose prose-lg max-w-none"
                            dangerouslySetInnerHTML={{ __html: post.content }}
                        />
                    </article>
                </div>
            </div>
        </PublicLayout>
    );
}