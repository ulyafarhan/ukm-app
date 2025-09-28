import MemberLayout from '@/Layouts/member/member-layout';
import { Head, Link } from '@inertiajs/react';
import {
    UsersIcon,
    CalendarIcon,
    BanknotesIcon,
    ArrowRightIcon,
    BellIcon,
    CheckCircleIcon,
    XCircleIcon,
    ArchiveBoxIcon,
    BuildingStorefrontIcon,
    ChartBarIcon,
    DocumentTextIcon
} from '@heroicons/react/24/outline';

export default function Dashboard({ auth, dashboardData }) {
    // --- Data Dummy (Gantilah dengan data asli dari props/backend) ---
    // Backend Anda harus mengirimkan objek 'dashboardData' dengan struktur seperti ini.
    const data = dashboardData || {
        stats: {
            membershipStatus: 'Aktif',
            duesStatus: 'Lunas',
            eventsAttended: 12,
            activityPoints: 150,
        },
        notifications: [
            { id: 1, type: 'warning', text: 'Iuran bulan Oktober 2025 akan jatuh tempo dalam 5 hari.' },
            { id: 2, type: 'info', text: 'Pendaftaran untuk "Workshop Kepemimpinan" telah dibuka!' },
            { id: 3, type: 'success', text: 'Sertifikat Anda untuk "Pelatihan Desain Grafis" sudah terbit.' },
        ],
        upcomingEvents: [
            { id: 1, title: 'Rapat Akbar & Pleno Tahunan', date: '2025-10-05', location: 'Aula Utama', time: '19:00 WIB' },
            { id: 2, title: 'Workshop Public Speaking', date: '2025-10-12', location: 'Ruang Seminar Gedung B', time: '09:00 WIB' },
            { id: 3, title: 'Bakti Sosial & Pengabdian Masyarakat', date: '2025-10-25', location: 'Desa Binaan Cemerlang', time: '08:00 WIB' },
        ],
        financeSummary: {
            currentMonth: 'September 2025',
            status: 'Lunas',
            amount: 15000,
            paid_at: '2025-09-05',
        },
        announcements: [
            { id: 1, title: "Panduan Penggunaan Sistem Inventaris Baru", date: "2025-09-27" },
            { id: 2, title: "Jadwal Pemilihan Ketua Umum Periode 2026", date: "2025-09-25" },
        ]
    };
    // --- Akhir Data Dummy ---

    const formatDate = (dateString) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    };

    const Notification = ({ type, text }) => {
        const baseClasses = "flex items-start p-4 rounded-lg mb-3";
        const typeClasses = {
            info: 'bg-blue-50 text-blue-800',
            success: 'bg-green-50 text-green-800',
            warning: 'bg-yellow-50 text-yellow-800',
        };
        const Icon = {
            info: <BellIcon className="h-5 w-5 mr-3 flex-shrink-0" />,
            success: <CheckCircleIcon className="h-5 w-5 mr-3 flex-shrink-0" />,
            warning: <BellIcon className="h-5 w-5 mr-3 flex-shrink-0" />,
        };
        return (
            <div className={`${baseClasses} ${typeClasses[type]}`}>
                {Icon[type]}
                <p className="text-sm font-medium">{text}</p>
            </div>
        );
    };

    return (
        <MemberLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dasbor Anggota</h2>}
        >
            <Head title={`Dasbor ${auth.user.name}`} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {/* Welcome Header */}
                    <div className="mb-8 px-4 sm:px-0">
                        <h1 className="text-3xl font-bold text-gray-900">Selamat Datang Kembali, {auth.user.name}!</h1>
                        <p className="mt-1 text-gray-600">Ini adalah ringkasan aktivitas dan informasi penting Anda di UKM.</p>
                    </div>

                    {/* Quick Stats Grid */}
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div className="bg-white p-6 rounded-lg shadow-sm flex items-center">
                            <UsersIcon className="h-8 w-8 text-teal-600 mr-4"/>
                            <div>
                                <p className="text-sm text-gray-500">Status Keanggotaan</p>
                                <p className={`text-xl font-bold ${data.stats.membershipStatus === 'Aktif' ? 'text-green-600' : 'text-red-600'}`}>
                                    {data.stats.membershipStatus}
                                </p>
                            </div>
                        </div>
                        <div className="bg-white p-6 rounded-lg shadow-sm flex items-center">
                            <BanknotesIcon className="h-8 w-8 text-teal-600 mr-4"/>
                            <div>
                                <p className="text-sm text-gray-500">Status Iuran</p>
                                <p className={`text-xl font-bold ${data.stats.duesStatus === 'Lunas' ? 'text-green-600' : 'text-red-600'}`}>
                                    {data.stats.duesStatus}
                                </p>
                            </div>
                        </div>
                        <div className="bg-white p-6 rounded-lg shadow-sm flex items-center">
                            <CalendarIcon className="h-8 w-8 text-teal-600 mr-4"/>
                            <div>
                                <p className="text-sm text-gray-500">Kegiatan Diikuti</p>
                                <p className="text-xl font-bold text-gray-800">{data.stats.eventsAttended}</p>
                            </div>
                        </div>
                        <div className="bg-white p-6 rounded-lg shadow-sm flex items-center">
                            <ChartBarIcon className="h-8 w-8 text-teal-600 mr-4"/>
                            <div>
                                <p className="text-sm text-gray-500">Poin Keaktifan</p>
                                <p className="text-xl font-bold text-gray-800">{data.stats.activityPoints}</p>
                            </div>
                        </div>
                    </div>

                    {/* Main Content Grid */}
                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {/* Left Column (Main) */}
                        <div className="lg:col-span-2 space-y-8">
                            {/* Action Items / Notifications */}
                            <div className="bg-white p-6 rounded-lg shadow-sm">
                                <h3 className="text-lg font-semibold text-gray-900 mb-4">Notifikasi & Tindakan</h3>
                                {data.notifications.length > 0 ? (
                                    data.notifications.map(notif => <Notification key={notif.id} {...notif} />)
                                ) : (
                                    <p className="text-sm text-gray-500">Tidak ada notifikasi baru untuk Anda.</p>
                                )}
                            </div>

                            {/* Upcoming Events */}
                            <div className="bg-white p-6 rounded-lg shadow-sm">
                                <h3 className="text-lg font-semibold text-gray-900 mb-4">Jadwal Kegiatan Terdekat</h3>
                                <div className="space-y-4">
                                {data.upcomingEvents.map(event => (
                                    <div key={event.id} className="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 border rounded-md hover:bg-gray-50">
                                        <div>
                                            <p className="font-semibold text-gray-800">{event.title}</p>
                                            <p className="text-sm text-gray-500">{formatDate(event.date)} &bull; {event.time} &bull; {event.location}</p>
                                        </div>
                                        <Link href="#" className="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-md hover:bg-teal-700 transition-colors">
                                            Lihat Detail
                                        </Link>
                                    </div>
                                ))}
                                </div>
                            </div>
                        </div>

                        {/* Right Column (Sidebar) */}
                        <div className="space-y-8">
                            {/* Finance Summary */}
                            <div className="bg-white p-6 rounded-lg shadow-sm">
                                <h3 className="text-lg font-semibold text-gray-900 mb-4">Ringkasan Keuangan</h3>
                                <p className="text-sm text-gray-500">Tagihan Iuran {data.financeSummary.currentMonth}</p>
                                {data.financeSummary.status === 'Lunas' ? (
                                    <div className="mt-2 text-green-600 flex items-center">
                                        <CheckCircleIcon className="h-6 w-6 mr-2" />
                                        <span className="font-bold text-lg">LUNAS</span>
                                    </div>
                                ) : (
                                     <div className="mt-2 text-red-600 flex items-center">
                                        <XCircleIcon className="h-6 w-6 mr-2" />
                                        <span className="font-bold text-lg">BELUM DIBAYAR</span>
                                    </div>
                                )}
                                <Link href={route('member.keuangan.index')} className="mt-4 w-full text-center inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Lihat Riwayat & Bayar
                                </Link>
                            </div>

                            {/* Quick Access */}
                            <div className="bg-white p-6 rounded-lg shadow-sm">
                                <h3 className="text-lg font-semibold text-gray-900 mb-4">Akses Cepat</h3>
                                <ul className="space-y-2">
                                    {[
                                        { label: 'Repositori Dokumen', href: route('member.dokumen.index'), icon: DocumentTextIcon },
                                        { label: 'Daftar Anggota', href: route('member.anggota.index'), icon: UsersIcon },
                                        { label: 'Peminjaman Inventaris', href: '#', icon: ArchiveBoxIcon },
                                        { label: 'Produk Kewirausahaan', href: '#', icon: BuildingStorefrontIcon },
                                    ].map(item => (
                                        <li key={item.label}>
                                            <Link href={item.href} className="group flex items-center justify-between p-3 rounded-md hover:bg-gray-100 transition-colors">
                                                <div className="flex items-center">
                                                    <item.icon className="h-5 w-5 mr-3 text-gray-500 group-hover:text-teal-600"/>
                                                    <span className="font-medium text-gray-700 group-hover:text-teal-600">{item.label}</span>
                                                </div>
                                                <ArrowRightIcon className="h-4 w-4 text-gray-400 group-hover:translate-x-1 transition-transform"/>
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                            
                            {/* Announcements */}
                            <div className="bg-white p-6 rounded-lg shadow-sm">
                                <h3 className="text-lg font-semibold text-gray-900 mb-4">Pengumuman Terbaru</h3>
                                <ul className="space-y-3">
                                    {data.announcements.map(item => (
                                        <li key={item.id}>
                                            <Link href="#" className="group">
                                                <p className="font-semibold text-gray-800 group-hover:text-teal-600">{item.title}</p>
                                                <p className="text-xs text-gray-500">{formatDate(item.date)}</p>
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </MemberLayout>
    );
}