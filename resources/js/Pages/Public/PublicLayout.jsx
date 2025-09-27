import { Link } from '@inertiajs/react';
import ApplicationLogo from '@/Components/ApplicationLogo';

export default function PublicLayout({ children, auth }) {
    return (
        <div className="min-h-screen bg-gray-50 text-gray-800 antialiased">
            <header className="bg-white/80 backdrop-blur-md shadow-sm fixed top-0 left-0 right-0 z-50">
                <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between items-center h-20">
                        <div className="flex items-center">
                            <Link href="/" className="flex items-center gap-2">
                                <ApplicationLogo className="block h-10 w-auto" />
                                <span className="font-bold text-xl text-gray-700">UKM PTQ</span>
                            </Link>
                        </div>

                        <nav className="hidden md:flex items-center space-x-8">
                            <Link href={route('home')} className="font-semibold text-gray-600 hover:text-teal-600 transition duration-300">Beranda</Link>
                            <Link href={route('news.index')} className="font-semibold text-gray-600 hover:text-teal-600 transition duration-300">Berita</Link>
                            <Link href={route('blog.index')} className="font-semibold text-gray-600 hover:text-teal-600 transition duration-300">Blog</Link>
                            <Link href={route('register.member.create')} className="font-semibold text-gray-600 hover:text-teal-600 transition duration-300">Pendaftaran</Link>
                            <a href="#tentang-kami" className="font-semibold text-gray-600 hover:text-teal-600 transition duration-300">Tentang Kami</a>
                        </nav>

                        <div className="flex items-center gap-4">
                            {auth && auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="rounded-md px-4 py-2 text-sm font-semibold text-white bg-teal-700 hover:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition"
                                >
                                    Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="rounded-md px-4 py-2 text-sm font-semibold text-gray-700 hover:text-teal-600 transition"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="rounded-md px-4 py-2 text-sm font-semibold text-white bg-teal-700 hover:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition hidden sm:block"
                                    >
                                        Register
                                    </Link>
                                </>
                            )}
                        </div>
                    </div>
                </div>
            </header>

            <main className="pt-20">
                {children}
            </main>

            <footer className="bg-gray-800 text-white">
                <div className="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <div className="flex items-center gap-2 mb-4">
                               <ApplicationLogo className="block h-10 w-auto" />
                               <span className="font-bold text-xl">UKM PTQ</span>
                            </div>
                            <p className="text-gray-400 text-sm">
                                Platform digital untuk manajemen dan administrasi Unit Kegiatan Mahasiswa yang lebih efisien dan terorganisir.
                            </p>
                        </div>
                        <div>
                            <h3 className="text-lg font-semibold mb-4">Tautan Cepat</h3>
                            <ul className="space-y-2 text-sm">
                                <li><a href="#tentang-kami" className="text-gray-400 hover:text-white transition">Tentang Kami</a></li>
                                <li><Link href={route('news.index')} className="text-gray-400 hover:text-white transition">Berita & Acara</Link></li>
                                <li><a href="#" className="text-gray-400 hover:text-white transition">Hubungi Kami</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 className="text-lg font-semibold mb-4">Ikuti Kami</h3>
                            <div className="flex space-x-4">
                                <a href="#" className="text-gray-400 hover:text-white transition"><svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fillRule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clipRule="evenodd" /></svg></a>
                                <a href="#" className="text-gray-400 hover:text-white transition"><svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg></a>
                                <a href="#" className="text-gray-400 hover:text-white transition"><svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fillRule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.08 2.525c.636-.247 1.363-.416 2.427-.465C9.53 2.013 9.884 2 12.315 2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm6.406-11.845a1.25 1.25 0 100 2.5 1.25 1.25 0 000-2.5z" clipRule="evenodd" /></svg></a>
                            </div>
                        </div>
                    </div>
                    <div className="mt-8 border-t border-gray-700 pt-6 text-center text-sm text-gray-400">
                        <p>&copy; {new Date().getFullYear()} UKM PTQ. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    );
}