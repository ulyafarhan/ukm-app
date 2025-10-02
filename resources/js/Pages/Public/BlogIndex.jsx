import React from "react";
import { Head, Link } from "@inertiajs/react";
import PublicLayout from './PublicLayout';
import { Pagination } from "@/Components/Pagination"; // Diperbaiki

export default function BlogIndex({ posts }) {

    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    };

    return (
        <PublicLayout>
            <Head title="Blog" />
            <div className="py-20 bg-gray-50">
                <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-12">
                        <h1 className="text-4xl font-bold text-gray-800">Berita & Informasi UKM</h1>
                        <p className="text-gray-500 mt-2">Ikuti semua perkembangan dan kegiatan terbaru dari kami.</p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {posts.data.map((post) => (
                            <div key={post.id} className="bg-white rounded-lg shadow-md overflow-hidden group transition-shadow duration-300 hover:shadow-xl">
                                <Link href={route('blog.show', post.slug)}>
                                    <img
                                        className="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300"
                                        src={post.thumbnail_url || `https://placehold.co/600x400/0f766e/FFFFFF?text=Berita`}
                                        alt={post.title}
                                    />
                                </Link>
                                <div className="p-6">
                                    <p className="text-sm text-gray-500 mb-2">{formatDate(post.published_at)}</p>
                                    <h3 className="text-xl font-semibold text-gray-800 mb-3 h-16 overflow-hidden">
                                        <Link href={route('blog.show', post.slug)} className="hover:text-teal-600 transition-colors">
                                            {post.title}
                                        </Link>
                                    </h3>
                                    <Link
                                        href={route('blog.show', post.slug)}
                                        className="font-semibold text-indigo-600 hover:text-indigo-800 transition-colors"
                                    >
                                        Baca Selengkapnya &rarr;
                                    </Link>
                                </div>
                            </div>
                        ))}
                    </div>

                    <div className="mt-12">
                        <Pagination links={posts.links} />
                    </div>
                </div>
            </div>
        </PublicLayout>
    );
}