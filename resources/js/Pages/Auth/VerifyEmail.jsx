import GuestLayout from '@/Layouts/GuestLayout';
import PrimaryButton from '@/Components/PrimaryButton';
import { Head, Link, useForm } from '@inertiajs/react';

export default function VerifyEmail({ status }) {
    const { post, processing } = useForm({});

    const submit = (e) => {
        e.preventDefault();
        post(route('verification.send'));
    };

    return (
        <GuestLayout>
            <Head title="Verifikasi Email" />

            <div className='text-center lg:text-left'>
                <h1 className="text-3xl font-bold text-gray-800 mb-4">Verifikasi Alamat Email Anda</h1>

                <div className="mb-4 text-sm text-gray-600">
                    Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik
                    tautan yang baru saja kami kirimkan ke email Anda? Jika Anda tidak menerima email, kami akan dengan senang hati
                    mengirimkan yang lain.
                </div>

                {status === 'verification-link-sent' && (
                    <div className="mb-4 font-medium text-sm text-green-600">
                        Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
                    </div>
                )}

                <form onSubmit={submit}>
                    <div className="mt-6 flex items-center justify-between">
                        <PrimaryButton disabled={processing}>Kirim Ulang Email Verifikasi</PrimaryButton>
                        <Link
                            href={route('logout')}
                            method="post"
                            as="button"
                            className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Log Out
                        </Link>
                    </div>
                </form>
            </div>
        </GuestLayout>
    );
}