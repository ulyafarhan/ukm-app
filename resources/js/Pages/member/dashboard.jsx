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
    const { stats, upcomingEvents, latestTransactions } = dashboardData;
    
    const formatDate = (dateString) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    };

    const Notification = ({ type, text }) => {
        // ... komponen notifikasi (tidak berubah)
    };

    return (
        <MemberLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dasbor Anggota</h2>}
        >
            <Head title={`Dasbor ${auth.user.name}`} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="mb-8 px-4 sm:px-0">
                        <h1 className="text-3xl font-bold text-gray-900">Selamat Datang Kembali, {auth.user.name}!</h1>
                        <p className="mt-1 text-gray-600">Ini adalah ringkasan aktivitas dan informasi penting Anda di UKM.</p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div className="bg-white p-6 rounded-lg shadow-sm flex items-center">
                            <UsersIcon className="h-8 w-8 text-teal-600 mr-4"/>
                            <div>
                                <p className="text-sm text-gray-500">Status Keanggotaan</p>
                                <p className={`text-xl font-bold ${stats.membershipStatus === 'Aktif' ? 'text-green-600' : 'text-red-600'}`}>
                                    {stats.membershipStatus}
                                </p>
                            </div>
                        </div>
                        <div className="bg-white p-6 rounded-lg shadow-sm flex items-center">
                            <BanknotesIcon className="h-8 w-8 text-teal-600 mr-4"/>
                            <div>
                                <p className="text-sm text-gray-500">Iuran Bulan Ini</p>
                                <p className={`text-xl font-bold ${stats.duesStatus === 'Lunas' ? 'text-green-600' : 'text-red-600'}`}>
                                    {stats.duesStatus}
                                </p>
                            </div>
                        </div>
                        {/* ... stats lainnya ... */}
                    </div>

                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div className="lg:col-span-2 space-y-8">
                            <div className="bg-white p-6 rounded-lg shadow-sm">
                                <h3 className="text-lg font-semibold text-gray-900 mb-4">Jadwal Kegiatan Terdekat</h3>
                                <div className="space-y-4">
                                {upcomingEvents.map(event => (
                                    <div key={event.id} className="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 border rounded-md hover:bg-gray-50">
                                        <div>
                                            <p className="font-semibold text-gray-800">{event.title}</p>
                                            <p className="text-sm text-gray-500">{formatDate(event.start_date)} &bull; {event.location}</p>
                                        </div>
                                        <Link href={route('member.kegiatan.index')} className="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-md hover:bg-teal-700 transition-colors">
                                            Lihat Detail
                                        </Link>
                                    </div>
                                ))}
                                </div>
                            </div>
                        </div>

                        <div className="space-y-8">
                           {/* ... ringkasan keuangan dan akses cepat ... */}
                        </div>
                    </div>
                </div>
            </div>
        </MemberLayout>
    );
}