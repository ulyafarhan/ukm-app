import MemberLayout from '@/layouts/member/member-layout';
import { Head } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';

export default function MemberIndex({ auth, members }) {
    return (
        <MemberLayout user={auth.user}>
            <Head title="Daftar Anggota" />
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Daftar Anggota</h1>
                    <p className="text-muted-foreground">
                        Berikut adalah daftar anggota UKM yang aktif.
                    </p>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>Anggota Aktif</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead className="w-[100px]">NIM</TableHead>
                                    <TableHead>Nama</TableHead>
                                    <TableHead>Jurusan</TableHead>
                                    <TableHead className="text-right">Angkatan</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {members.length > 0 ? (
                                    members.map((member) => (
                                        <TableRow key={member.id}>
                                            <TableCell className="font-medium">{member.student_id}</TableCell>
                                            <TableCell>{member.name}</TableCell>
                                            <TableCell>{member.major}</TableCell>
                                            <TableCell className="text-right">{member.entry_year}</TableCell>
                                        </TableRow>
                                    ))
                                ) : (
                                    <TableRow>
                                        <TableCell colSpan={4} className="h-24 text-center">
                                            Belum ada data anggota.
                                        </TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </MemberLayout>
    );
}