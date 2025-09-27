import { Link } from '@inertiajs/react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import HeroImage from '../../../public/images/hero-background.jpg';

export default function Guest({ children }) {
    return (
        <div className="min-h-screen flex flex-col lg:flex-row bg-white">
            {/* Sisi Kiri - Hero */}
            <div
                className="hidden lg:flex w-1/2 bg-cover bg-center relative"
                style={{ backgroundImage: `url(${HeroImage})` }}
            >
                {/* Overlay gradient gelap agar teks jelas */}
                <div className="absolute inset-0 bg-gradient-to-br from-black/60 via-black/50 to-black/60" />

                {/* Konten Branding */}
                <div className="relative z-10 w-full h-full flex flex-col justify-between p-12 text-white">
                    {/* Logo */}
                    <div className="flex items-center gap-3">
                        <Link
                            href="/"
                            className="flex items-center gap-3 transform transition-transform duration-300 hover:scale-105"
                        >
                            <ApplicationLogo className="w-12 h-12 fill-current text-white drop-shadow-lg" />
                            <span className="text-2xl font-bold tracking-wide">UKM PTQ</span>
                        </Link>
                    </div>

                    {/* Headline */}
                    <div>
                        <h2 className="text-4xl xl:text-5xl font-extrabold leading-tight drop-shadow-md">
                            Bergabunglah dengan Komunitas Kami
                        </h2>
                        <p className="mt-4 text-lg text-gray-200 max-w-md">
                            Satu platform untuk semua kebutuhan administrasi dan kegiatan UKM Anda.
                        </p>
                    </div>
                </div>
            </div>

            {/* Sisi Kanan - Form */}
            <div className="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
                <div className="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    {children}
                </div>
            </div>
        </div>
    );
}