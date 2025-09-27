import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

// Komponen untuk kartu statistik
const StatCard = ({ icon, title, value, description }) => (
    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div className="p-6 flex items-start space-x-4">
            <div className="flex-shrink-0">
                <div className="bg-amber-100 text-amber-600 rounded-md p-3">
                    <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" dangerouslySetInnerHTML={{ __html: icon }} />
                </div>
            </div>
            <div>
                <dt className="text-sm font-medium text-gray-500 truncate">{title}</dt>
                <dd className="mt-1 text-3xl font-semibold text-gray-900">{value}</dd>
                <p className="text-sm text-gray-500">{description}</p>
            </div>
        </div>
    </div>
);

// Komponen untuk item acara
const EventItem = ({ event }) => {
    const formatDate = (dateString) => {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    };

    return (
        <li className="p-4 hover:bg-gray-50 rounded-md transition-colors">
            <div className="flex items-center space-x-4">
                <div className="flex-shrink-0 text-center bg-amber-500 text-white rounded-lg p-3 w-20">
                    <p className="text-3xl font-bold">{new Date(event.date).getDate()}</p>
                    <p className="text-sm">{new Date(event.date).toLocaleString('id-ID', { month: 'short' })}</p>
                </div>
                <div className="flex-1 min-w-0">
                    <p className="text-lg font-semibold text-gray-900 truncate">{event.title}</p>
                    <p className="text-sm text-gray-500 truncate">{event.location}</p>
                    <p className="text-sm text-gray-500">{formatDate(event.date)}</p>
                </div>
            </div>
        </li>
    );
};


export default function Dashboard({ auth, stats, upcomingEvents }) {
    const icons = {
        members: '<path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
        events: '<path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />',
        upcoming: '<path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 10V3L4 14h7v7l9-11h-7z" />'
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard Anggota</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {/* Welcome Message */}
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div className="p-6 text-gray-900">
                            Selamat datang kembali, <span className="font-bold">{auth.user.name}</span>!
                        </div>
                    </div>
                    
                    {/* Stats Overview */}
                    <div className="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-6">
                        <StatCard icon={icons.members} title="Total Anggota" value={stats.totalMembers} description="Seluruh anggota terdaftar"/>
                        <StatCard icon={icons.events} title="Total Acara" value={stats.totalEvents} description="Acara yang sudah terlaksana"/>
                        <StatCard icon={icons.upcoming} title="Acara Mendatang" value={stats.upcomingEventsCount} description="Acara dalam waktu dekat"/>
                    </div>

                    {/* Upcoming Events */}
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6">
                            <h3 className="text-lg font-medium leading-6 text-gray-900 mb-4">
                                5 Acara Terdekat
                            </h3>
                            <ul className="divide-y divide-gray-200">
                                {upcomingEvents.length > 0 ? (
                                    upcomingEvents.map(event => <EventItem key={event.id} event={event} />)
                                ) : (
                                    <li className="p-4 text-center text-gray-500">
                                        Belum ada acara yang akan datang.
                                    </li>
                                )}
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </AuthenticatedLayout>
    );
}