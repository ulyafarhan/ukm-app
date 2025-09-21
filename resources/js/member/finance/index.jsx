import MemberLayout from '@/layouts/member/member-layout';
import { Head, Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';
import { ArrowUpCircle, ArrowDownCircle, Wallet } from 'lucide-react';

// Fungsi helper untuk format mata uang Rupiah
const formatCurrency = (amount) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(amount);
};

// Fungsi helper untuk format tanggal
const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    });
};

export default function FinanceIndex({ auth, transactions, stats }) {
    return (
        <MemberLayout user={auth.user}>
            <Head title="Laporan Keuangan" />
            <div className="space-y-6">
                {/* Header Halaman */}
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Laporan Keuangan</h1>
                    <p className="text-muted-foreground">
                        Riwayat semua transaksi pemasukan dan pengeluaran dana UKM.
                    </p>
                </div>

                {/* Kartu Statistik */}
                <div className="grid gap-4 md:grid-cols-3">
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Pemasukan</CardTitle>
                            <ArrowUpCircle className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-green-600">{formatCurrency(stats.totalIncome)}</div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Pengeluaran</CardTitle>
                            <ArrowDownCircle className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-red-600">{formatCurrency(stats.totalOutcome)}</div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Saldo Akhir</CardTitle>
                            <Wallet className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{formatCurrency(stats.finalBalance)}</div>
                        </CardContent>
                    </Card>
                </div>

                {/* Tabel Transaksi */}
                <Card>
                    <CardHeader>
                        <CardTitle>Riwayat Transaksi</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Tanggal</TableHead>
                                    <TableHead>Deskripsi</TableHead>
                                    <TableHead>Kategori</TableHead>
                                    <TableHead className="text-right">Jumlah</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {transactions.data.length > 0 ? (
                                    transactions.data.map((trx) => (
                                        <TableRow key={trx.id}>
                                            <TableCell>{formatDate(trx.transaction_date)}</TableCell>
                                            <TableCell className="font-medium">{trx.description}</TableCell>
                                            <TableCell>
                                                <Badge variant="outline">{trx.category?.name || 'N/A'}</Badge>
                                            </TableCell>
                                            <TableCell className={`text-right font-semibold ${trx.type === 'income' ? 'text-green-600' : 'text-red-600'}`}>
                                                {trx.type === 'income' ? '+' : '-'} {formatCurrency(trx.amount)}
                                            </TableCell>
                                        </TableRow>
                                    ))
                                ) : (
                                    <TableRow>
                                        <TableCell colSpan={4} className="h-24 text-center">
                                            Belum ada transaksi yang dicatat.
                                        </TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>

                {/* Komponen Paginasi */}
                {transactions.links.length > 3 && (
                     <div className="flex items-center justify-between mt-6">
                        <div className="text-sm text-muted-foreground">
                            Menampilkan {transactions.from} sampai {transactions.to} dari {transactions.total} hasil
                        </div>
                        <div className="flex items-center gap-2">
                            {transactions.links.map((link, index) => (
                                <Link
                                    key={index}
                                    href={link.url}
                                    className={`px-3 py-1.5 text-sm rounded-md ${
                                        link.active ? 'bg-primary text-primary-foreground' : 'bg-card hover:bg-muted'
                                    } ${!link.url ? 'text-muted-foreground cursor-not-allowed' : ''}`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                    preserveState
                                    preserveScroll
                                />
                            ))}
                        </div>
                    </div>
                )}
            </div>
        </MemberLayout>
    );
}