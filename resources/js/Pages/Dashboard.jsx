import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

// Komponen untuk ikon SVG
const UsersIcon = () => <svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeWidth="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.122-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.122-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>;
const CalendarIcon = () => <svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>;
const CubeIcon = () => <svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7l8 4" /></svg>;

export default function Dashboard({ auth, stats, latestEvents, latestProducts }) {

    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard Informasi UKM</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {/* Bagian Statistik Utama */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center gap-6">
                            <div className="bg-teal-100 text-teal-700 p-4 rounded-full">
                                <UsersIcon />
                            </div>
                            <div>
                                <p className="text-sm font-medium text-gray-500">Total Anggota</p>
                                <p className="text-3xl font-bold text-gray-800">{stats.total_members}</p>
                            </div>
                        </div>
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center gap-6">
                            <div className="bg-indigo-100 text-indigo-600 p-4 rounded-full">
                                <CalendarIcon />
                            </div>
                            <div>
                                <p className="text-sm font-medium text-gray-500">Berita & Acara</p>
                                <p className="text-3xl font-bold text-gray-800">{stats.total_events}</p>
                            </div>
                        </div>
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center gap-6">
                            <div className="bg-amber-100 text-amber-600 p-4 rounded-full">
                                <CubeIcon />
                            </div>
                            <div>
                                <p className="text-sm font-medium text-gray-500">Produk UKM</p>
                                <p className="text-3xl font-bold text-gray-800">{stats.total_products}</p>
                            </div>
                        </div>
                    </div>

                    {/* Konten Utama: Berita dan Produk */}
                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {/* Kolom Berita Terbaru (2/3 Lebar) */}
                        <div className="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div className="flex justify-between items-center mb-6">
                                <h3 className="text-2xl font-bold text-gray-800">Berita & Acara Terbaru</h3>
                                <Link href={route('news.index')} className="font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                                    Lihat Semua &rarr;
                                </Link>
                            </div>
                            <div className="space-y-6">
                                {latestEvents.map(event => (
                                    <div key={event.id} className="group flex flex-col md:flex-row items-center gap-6 p-4 rounded-lg hover:bg-gray-50 transition-colors">
                                        {/* --- PERBAIKAN DI BAGIAN INI --- */}
                                        <div className="w-full h-40 md:w-48 md:h-32 rounded-md overflow-hidden flex-shrink-0">
                                            <img
                                                className="w-full h-full object-cover shadow-sm"
                                                src={event.image_url || `https://placehold.co/600x400/0f766e/FFFFFF?text=UKM+Event`}
                                                alt={event.title}
                                            />
                                        </div>
                                        {/* --- AKHIR PERBAIKAN --- */}
                                        <div className="flex-1">
                                            <p className="text-sm text-gray-500 mb-1">{formatDate(event.created_at)}</p>
                                            <h4 className="text-lg font-bold text-gray-800 group-hover:text-teal-700 transition-colors">
                                                <Link href={route('news.detail', event.id)}>{event.title}</Link>
                                            </h4>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Kolom Produk (1/3 Lebar) */}
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                             <h3 className="text-2xl font-bold text-gray-800 mb-6">Produk Kewirausahaan</h3>
                             <div className="grid grid-cols-2 gap-4">
                                {latestProducts.map(product => (
                                    <div key={product.id} className="group">
                                        <div className="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-100">
                                            <img
                                                src={product.image_url || `https://placehold.co/400x400/fbbf24/FFFFFF?text=Produk`}
                                                alt={product.name}
                                                className="h-full w-full object-cover object-center group-hover:opacity-75 transition"
                                            />
                                        </div>
                                        <h4 className="mt-2 text-md font-semibold text-gray-800">{product.name}</h4>
                                        <p className="text-sm text-gray-500">{product.price}</p>
                                    </div>
                                ))}
                             </div>
                        </div>
                    </div>

                </div>
            </div>
        </AuthenticatedLayout>
    );
}