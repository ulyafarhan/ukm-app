import { Link, Head } from '@inertiajs/react';

export default function LandingPage({ auth, upcomingEvents, memberCount }) {
    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    };

    return (
        <>
            <Head title="Selamat Datang" />
            <div className="bg-gray-100 text-gray-800">
                {/* Navbar */}
                <header className="absolute inset-x-0 top-0 z-50">
                    <nav className="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                        <div className="flex lg:flex-1">
                            <a href="#" className="-m-1.5 p-1.5">
                                <span className="sr-only">UKM App</span>
                                <img
                                    className="h-8 w-auto"
                                    src="https://tailwindui.com/img/logos/mark.svg?color=amber&shade=600"
                                    alt=""
                                />
                            </a>
                        </div>
                        <div className="lg:flex lg:flex-1 lg:justify-end">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="text-sm font-semibold leading-6 text-gray-900"
                                >
                                    Dashboard <span aria-hidden="true">&rarr;</span>
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="text-sm font-semibold leading-6 text-gray-900 mr-6"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="text-sm font-semibold leading-6 text-gray-900"
                                    >
                                        Register
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                {/* Hero Section */}
                <div className="relative isolate px-6 pt-14 lg:px-8 min-h-screen flex items-center">
                    <div className="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                        <div className="text-center">
                            <h1 className="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                                Sistem Informasi Unit Kegiatan Mahasiswa
                            </h1>
                            <p className="mt-6 text-lg leading-8 text-gray-600">
                                Wadah untuk mengelola semua aktivitas, anggota, dan keuangan UKM secara efisien dan transparan. Bergabunglah dengan kami dan kembangkan potensimu!
                            </p>
                            <div className="mt-10 flex items-center justify-center gap-x-6">
                                <Link
                                    href={route('register')}
                                    className="rounded-md bg-amber-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-amber-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600"
                                >
                                    Daftar Sekarang
                                </Link>
                                <a href="#events" className="text-sm font-semibold leading-6 text-gray-900">
                                    Lihat Acara <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Upcoming Events Section */}
                <div id="events" className="bg-white py-24 sm:py-32">
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="mx-auto max-w-2xl lg:mx-0">
                            <h2 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Acara Mendatang</h2>
                            <p className="mt-2 text-lg leading-8 text-gray-600">
                                Jangan lewatkan berbagai kegiatan seru dan bermanfaat dari kami.
                            </p>
                        </div>
                        <div className="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                            {upcomingEvents.map((event) => (
                                <article key={event.id} className="flex max-w-xl flex-col items-start justify-between">
                                    <div className="flex items-center gap-x-4 text-xs">
                                        <time dateTime={event.date} className="text-gray-500">
                                            {formatDate(event.date)}
                                        </time>
                                        <span className="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600">
                                            {event.location}
                                        </span>
                                    </div>
                                    <div className="group relative">
                                        <h3 className="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                            <span className="absolute inset-0" />
                                            {event.title}
                                        </h3>
                                        <p className="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{event.description}</p>
                                    </div>
                                </article>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Member Count Section */}
                 <div className="relative isolate overflow-hidden bg-gray-900 py-24 sm:py-32">
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="mx-auto max-w-2xl lg:mx-0">
                            <h2 className="text-4xl font-bold tracking-tight text-white sm:text-6xl">Bergabunglah Bersama Kami</h2>
                            <p className="mt-6 text-lg leading-8 text-gray-300">
                                Jadilah bagian dari komunitas yang aktif, kreatif, dan inovatif. Saat ini kami memiliki <span className="font-bold text-amber-400">{memberCount} anggota</span> yang tersebar di berbagai jurusan.
                            </p>
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <footer className="bg-gray-800 text-white p-4 text-center">
                    <p>&copy; {new Date().getFullYear()} UKM App. All rights reserved.</p>
                </footer>
            </div>
        </>
    );
}