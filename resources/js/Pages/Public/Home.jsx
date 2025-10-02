import PublicLayout from './PublicLayout';
import { Head, Link } from '@inertiajs/react';
import HeroImage from '../../../../public/images/hero-background.jpg';


export default function Home({ auth, posts }) {

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
            <div className="absolute inset-0 bg-black/60"></div>

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
                        {/* ... card kegiatan ... */}
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
                        {posts.map((post) => (
                            <div key={post.id} className="bg-white rounded-lg shadow-md overflow-hidden group transition-shadow duration-300 hover:shadow-xl">
                                <Link href={route('news.detail', post.slug)}>
                                    <img
                                        className="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300"
                                        src={post.image_url || `https://placehold.co/600x400/0f766e/FFFFFF?text=UKM+Event`}
                                        alt={post.title}
                                    />
                                </Link>
                                <div className="p-6">
                                    <p className="text-sm text-gray-500 mb-2">{formatDate(post.created_at)}</p>
                                    <h3 className="text-xl font-semibold text-gray-800 mb-3 h-16 overflow-hidden">
                                        <Link href={route('news.detail', post.slug)} className="hover:text-teal-600 transition-colors">
                                            {post.title}
                                        </Link>
                                    </h3>
                                    <Link
                                        href={route('news.detail', post.slug)}
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