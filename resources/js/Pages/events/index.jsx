import MemberLayout from '@/layouts/member/member-layout';
import { Head } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Calendar, MapPin } from 'lucide-react';

// Helper untuk format tanggal
const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
        weekday: 'long', day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit'
    });
};

const EventCard = ({ event }) => (
    <Card>
        <CardHeader>
            <div className="flex justify-between items-start">
                <div>
                    <CardTitle className="mb-1">{event.name}</CardTitle>
                    <CardDescription className="flex items-center gap-2 text-sm">
                        <Calendar className="h-4 w-4" />
                        {formatDate(event.start_date)}
                    </CardDescription>
                </div>
                <Badge variant={event.status === 'ongoing' ? 'default' : 'outline'}>
                    {event.status}
                </Badge>
            </div>
        </CardHeader>
        <CardContent>
            <p className="text-sm text-muted-foreground mb-4">{event.description}</p>
            <div className="flex items-center text-xs text-muted-foreground gap-2">
                <MapPin className="h-4 w-4" />
                <span>{event.location || 'Lokasi belum ditentukan'}</span>
            </div>
        </CardContent>
    </Card>
);

export default function EventIndex({ auth, upcomingEvents, pastEvents }) {
    return (
        <MemberLayout user={auth.user}>
            <Head title="Jadwal Kegiatan" />
            <div className="space-y-8">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Jadwal Kegiatan</h1>
                    <p className="text-muted-foreground">
                        Semua acara dan kegiatan yang direncanakan oleh UKM.
                    </p>
                </div>

                {/* Kegiatan Akan Datang */}
                <div className="space-y-4">
                    <h2 className="text-xl font-semibold">Akan Datang</h2>
                    {upcomingEvents.length > 0 ? (
                        upcomingEvents.map(event => <EventCard key={event.id} event={event} />)
                    ) : (
                        <p className="text-sm text-muted-foreground">Tidak ada kegiatan yang akan datang.</p>
                    )}
                </div>

                {/* Riwayat Kegiatan */}
                <div className="space-y-4">
                    <h2 className="text-xl font-semibold">Riwayat Kegiatan</h2>
                    {pastEvents.data.length > 0 ? (
                        pastEvents.data.map(event => <EventCard key={event.id} event={event} />)
                    ) : (
                        <p className="text-sm text-muted-foreground">Belum ada riwayat kegiatan.</p>
                    )}
                    {/* Di sini bisa ditambahkan paginasi untuk pastEvents jika diperlukan */}
                </div>
            </div>
        </MemberLayout>
    );
}