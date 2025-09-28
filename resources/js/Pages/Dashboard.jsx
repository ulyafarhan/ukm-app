import MemberLayout from '@/Layouts/member/member-layout';
import { Head } from '@inertiajs/react';

export default function Dashboard({ auth }) {
    return (
        <MemberLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard Anggota</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">Selamat datang di dasbor anggota!</div>
                    </div>
                </div>
            </div>
        </MemberLayout>
    );
}