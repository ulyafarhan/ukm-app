import MemberLayout from '@/Layouts/member/member-layout';
import { Head, Link } from '@inertiajs/react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/Components/ui/table";
import { ArrowUpRight, BadgeCheck, BadgeX, CalendarClock, Users, Activity } from 'lucide-react';

export default function Dashboard({ auth, dashboardData }) {
    const { stats, upcomingEvents, latestTransactions } = dashboardData;

    const formatDate = (dateString) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    };

    return (
        <MemberLayout
            user={auth.user}
            header={`Selamat Datang Kembali, ${auth.user.name}!`}
        >
            <Head title="Dashboard Anggota" />

            <div className="grid gap-4 md:grid-cols-2 md:gap-8 lg:grid-cols-4">
                <Card>
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle className="text-sm font-medium">Status Keanggotaan</CardTitle>
                        <Users className="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div className={`text-2xl font-bold ${stats.membershipStatus === 'Aktif' ? 'text-green-600' : 'text-red-600'}`}>{stats.membershipStatus}</div>
                        <p className="text-xs text-muted-foreground">
                            Keanggotaan Anda saat ini.
                        </p>
                    </CardContent>
                </Card>
                 <Card>
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle className="text-sm font-medium">Iuran Bulan Ini</CardTitle>
                        {stats.duesStatus === 'Lunas' ? <BadgeCheck className="h-4 w-4 text-green-600" /> : <BadgeX className="h-4 w-4 text-red-600" />}
                    </CardHeader>
                    <CardContent>
                        <div className={`text-2xl font-bold ${stats.duesStatus === 'Lunas' ? 'text-green-600' : 'text-red-600'}`}>{stats.duesStatus}</div>
                        <p className="text-xs text-muted-foreground">
                            Status pembayaran iuran wajib.
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle className="text-sm font-medium">Kegiatan Diikuti</CardTitle>
                        <CalendarClock className="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">{stats.eventsAttended}</div>
                        <p className="text-xs text-muted-foreground">
                            Total partisipasi dalam acara.
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle className="text-sm font-medium">Poin Keaktifan</CardTitle>
                        <Activity className="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">{stats.activityPoints}</div>
                        <p className="text-xs text-muted-foreground">
                            Akumulasi poin dari semua aktivitas.
                        </p>
                    </CardContent>
                </Card>
            </div>

            <div className="grid gap-4 md:gap-8 lg:grid-cols-2 xl:grid-cols-3">
                <Card className="xl:col-span-2">
                    <CardHeader className="flex flex-row items-center">
                        <div className="grid gap-2">
                            <CardTitle>Transaksi Terakhir</CardTitle>
                            <CardDescription>
                                Riwayat 5 transaksi terakhir Anda di UKM.
                            </CardDescription>
                        </div>
                        <Button asChild size="sm" className="ml-auto gap-1">
                            <Link href={route('member.keuangan.index')}>
                                Lihat Semua
                                <ArrowUpRight className="h-4 w-4" />
                            </Link>
                        </Button>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Deskripsi</TableHead>
                                    <TableHead className="text-right">Jumlah</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {latestTransactions.map((tx) => (
                                     <TableRow key={tx.id}>
                                        <TableCell>
                                            <div className="font-medium">{tx.description}</div>
                                            <div className="hidden text-sm text-muted-foreground md:inline">
                                                {formatDate(tx.transaction_date)}
                                            </div>
                                        </TableCell>
                                        <TableCell className={`text-right ${tx.type === 'income' ? 'text-green-600' : 'text-red-600'}`}>
                                            {new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(tx.amount)}
                                        </TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Kegiatan Akan Datang</CardTitle>
                         <CardDescription>
                            Jangan lewatkan acara-acara menarik berikutnya.
                        </CardDescription>
                    </CardHeader>
                    <CardContent className="grid gap-4">
                        {upcomingEvents.length > 0 ? (
                            upcomingEvents.map((event) => (
                                <div key={event.id} className="flex items-center gap-4">
                                    <div className="bg-muted text-muted-foreground rounded-md p-3 flex items-center justify-center">
                                        <CalendarClock className="h-6 w-6" />
                                    </div>
                                    <div className="grid gap-1">
                                        <p className="text-sm font-medium leading-none">
                                            {event.title}
                                        </p>
                                        <p className="text-sm text-muted-foreground">
                                            {formatDate(event.start_date)}
                                        </p>
                                    </div>
                                </div>
                            ))
                        ) : (
                             <p className="text-sm text-muted-foreground">Belum ada kegiatan yang dijadwalkan.</p>
                        )}
                         <Button asChild size="sm" className="mt-2 w-full">
                            <Link href={route('member.kegiatan.index')}>
                                Lihat Semua Kegiatan
                            </Link>
                        </Button>
                    </CardContent>
                </Card>
            </div>
        </MemberLayout>
    );
}