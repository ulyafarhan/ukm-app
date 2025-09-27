import { Link } from '@inertiajs/react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import HeroImage from '../../../public/images/hero-background.jpg';

export default function Guest({ children }) {
    return (
        <div className="min-h-screen flex bg-white">
            {/* Sisi Kiri - Gambar & Branding */}
            <div
                className="hidden lg:block w-1/2 bg-cover bg-center"
                style={{ backgroundImage: `url(${HeroImage})` }}
            >
                <div className="w-full h-full bg-teal-900/70 flex flex-col justify-between p-12 text-white">
                    <div>
                        <Link href="/" className="flex items-center gap-3">
                            <ApplicationLogo className="w-12 h-12 fill-current" />
                            <span className="text-2xl font-bold">UKM PTQ</span>
                        </Link>
                    </div>
                    <div>
                        <h2 className="text-4xl font-bold leading-tight">
                            Bergabunglah dengan Komunitas Kami.
                        </h2>
                        <p className="mt-4 text-lg text-teal-100">
                            Satu platform untuk semua kebutuhan administrasi dan kegiatan UKM Anda.
                        </p>
                    </div>
                </div>
            </div>

            {/* Sisi Kanan - Form */}
            <div className="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
                <div className="w-full max-w-md">
                    {children}
                </div>
            </div>
        </div>
    );
}