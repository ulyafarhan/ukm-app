import PublicLayout from './PublicLayout';
import { Head, Link } from '@inertiajs/react';
import HeroImage from '../../../../public/images/hero-background.jpg';

export default function Home({ auth, events }) {

    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    };

    return (
        <PublicLayout auth={auth}>
            <Head title="Selamat Datang di UKM PTQ" />

            <section
            className="relative flex items-center justify-center h-screen bg-cover bg-center bg-bottom text-white"
            style={{
                backgroundImage: `url(${HeroImage})`,
            }}
            >
            {/* dark overlay */}
            <div className="absolute inset-0 bg-black/60"></div>

            {/* content */}
            <div className="relative z-10 text-center px-4 sm:px-6 lg:px-8">
                <h1 className="text-4xl md:text-6xl font-extrabold mb-4 leading-tight drop-shadow-lg">
                Membangun Potensi, Meraih Prestasi
                </h1>
                <p className="text-lg md:text-xl max-w-3xl mx-auto drop-shadow-md">
                Selamat datang di portal resmi UKM kami. Temukan informasi terbaru,
                kegiatan, dan jadilah bagian dari komunitas kami.
                </p>
            </div>
            </section>

            <section id="kegiatan" className="py-20 bg-white">
                <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl md:text-4xl font-bold text-gray-800">Kegiatan Utama Kami</h2>
                        <p className="text-gray-500 mt-2 max-w-2xl mx-auto">
                            Kami berfokus pada pengembangan anggota melalui berbagai pilar kegiatan yang bermanfaat.
                        </p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div className="bg-gray-50 p-8 rounded-lg text-center shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div className="flex items-center justify-center h-16 w-16 bg-teal-100 text-teal-700 rounded-full mx-auto mb-4"><svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg></div>
                            <h3 className="text-xl font-semibold mb-2">Pelatihan & Skill</h3>
                            <p className="text-gray-600">Meningkatkan kompetensi anggota melalui workshop dan pelatihan rutin.</p>
                        </div>
                        <div className="bg-gray-50 p-8 rounded-lg text-center shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div className="flex items-center justify-center h-16 w-16 bg-teal-100 text-teal-700 rounded-full mx-auto mb-4"><svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg></div>
                            <h3 className="text-xl font-semibold mb-2">Kewirausahaan</h3>
                            <p className="text-gray-600">Mengembangkan jiwa bisnis dan kemandirian finansial anggota.</p>
                        </div>
                        <div className="bg-gray-50 p-8 rounded-lg text-center shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div className="flex items-center justify-center h-16 w-16 bg-teal-100 text-teal-700 rounded-full mx-auto mb-4"><svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg></div>
                            <h3 className="text-xl font-semibold mb-2">Pengabdian Masyarakat</h3>
                            <p className="text-gray-600">Memberikan kontribusi nyata dan dampak positif bagi lingkungan sekitar.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="berita" className="py-20 bg-gray-50">
                <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl md:text-4xl font-bold text-gray-800">Berita Terbaru</h2>
                        <p className="text-gray-500 mt-2 max-w-2xl mx-auto">Ikuti perkembangan dan kegiatan terbaru dari UKM kami.</p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {events.map((event) => (
                            <div key={event.id} className="bg-white rounded-lg shadow-md overflow-hidden group transition-shadow duration-300 hover:shadow-xl">
                                <Link href={route('blog.detail', post.slug)}>                                    <img
                                        className="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300"
                                        src={event.image_url || `https://placehold.co/600x400/0f766e/FFFFFF?text=UKM+Event`}
                                        alt={event.title}
                                    />
                                </Link>
                                <div className="p-6">
                                    <p className="text-sm text-gray-500 mb-2">{formatDate(event.created_at)}</p>
                                    <h3 className="text-xl font-semibold text-gray-800 mb-3 h-16 overflow-hidden">
                                        <Link href={route('news.detail', event.id)} className="hover:text-teal-600 transition-colors">
                                            {event.title}
                                        </Link>
                                    </h3>
                                    <Link
                                        href={route('news.detail', event.id)}
                                        className="font-semibold text-indigo-600 hover:text-indigo-800 transition-colors"
                                    >
                                        Baca Selengkapnya &rarr;
                                    </Link>
                                </div>
                            </div>
                        ))}
                    </div>
                     <div className="text-center mt-12">
                        <Link href={route('news.index')} className="inline-block bg-teal-700 text-white font-semibold px-8 py-3 rounded-lg hover:bg-teal-800 transition-colors duration-300">
                            Lihat Semua Berita
                        </Link>
                    </div>
                </div>
            </section>

            <section id="tentang-kami" className="py-20 bg-white">
                 <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center">
                        <h2 className="text-3xl md:text-4xl font-bold text-gray-800">Tentang UKM Kami</h2>
                        <p className="text-gray-600 mt-4 max-w-3xl mx-auto">
                            Kami adalah Unit Kegiatan Mahasiswa yang berdedikasi untuk menjadi wadah bagi para mahasiswa dalam menyalurkan minat, bakat, dan kreativitas. Dengan semangat kebersamaan, kami terus berinovasi untuk memberikan kontribusi terbaik bagi almamater dan masyarakat.
                        </p>
                    </div>
                 </div>
            </section>

        </PublicLayout>
    );
}