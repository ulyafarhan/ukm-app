import MemberLayout from '@/layouts/member/member-layout';
import { Head } from '@inertiajs/react';
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from '@/components/ui/accordion';
import { Button } from '@/components/ui/button';
import { FileText, Download } from 'lucide-react';

export default function DocumentIndex({ auth, documentCategories }) {
    return (
        <MemberLayout user={auth.user}>
            <Head title="Pusat Dokumen" />
            <div className="space-y-6">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">Pusat Dokumen</h1>
                    <p className="text-muted-foreground">
                        Unduh proposal, laporan, surat, dan dokumen penting lainnya.
                    </p>
                </div>

                {documentCategories.length > 0 ? (
                    <Accordion type="single" collapsible className="w-full">
                        {documentCategories.map((category) => (
                            <AccordionItem value={`item-${category.id}`} key={category.id}>
                                <AccordionTrigger className="text-lg">{category.name}</AccordionTrigger>
                                <AccordionContent>
                                    <div className="divide-y">
                                        {category.documents.map((doc) => (
                                            <div key={doc.id} className="flex items-center justify-between p-3">
                                                <div className="flex items-center gap-4">
                                                    <FileText className="h-6 w-6 text-muted-foreground" />
                                                    <div>
                                                        <p className="font-medium">{doc.title}</p>
                                                        <p className="text-sm text-muted-foreground">
                                                            Diunggah oleh: {doc.uploader.name}
                                                        </p>
                                                    </div>
                                                </div>
                                                <Button asChild variant="outline" size="sm">
                                                    <a href={`/storage/${doc.file_path}`} download>
                                                        <Download className="h-4 w-4 mr-2" />
                                                        Unduh
                                                    </a>
                                                </Button>
                                            </div>
                                        ))}
                                    </div>
                                </AccordionContent>
                            </AccordionItem>
                        ))}
                    </Accordion>
                ) : (
                    <div className="text-center py-12">
                        <p className="text-muted-foreground">Belum ada dokumen yang diunggah.</p>
                    </div>
                )}
            </div>
        </MemberLayout>
    );
}