import React from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import PublicLayout from './PublicLayout';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';

export default function RegisterMember({ isOpen, periodName, jetstream }) {
    const { data, setData, post, processing, errors, recentlySuccessful } = useForm({
        full_name: '',
        nim: '',
        faculty: '',
        department: '',
        year_in: '',
        phone_number: '',
        email: '',
        reason: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('register.member.store'));
    };
    
    return (
        <PublicLayout>
            <Head title="Pendaftaran Anggota" />
            <div className="py-20 bg-gray-50">
                <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
                        <div className="text-center mb-8">
                            <h1 className="text-3xl font-bold text-gray-800">{periodName}</h1>
                            {!isOpen && (
                                <p className="mt-2 text-lg text-red-600 font-semibold">
                                    Mohon maaf, pendaftaran saat ini sedang ditutup.
                                </p>
                            )}
                        </div>

                        {recentlySuccessful && (
                             <div className="mb-6 p-4 bg-green-100 text-green-800 border-l-4 border-green-500 rounded-md">
                                Pendaftaran Anda telah berhasil kami terima. Terima kasih!
                            </div>
                        )}

                        {isOpen ? (
                            <form onSubmit={submit}>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <InputLabel htmlFor="full_name" value="Nama Lengkap" />
                                        <TextInput id="full_name" value={data.full_name} onChange={e => setData('full_name', e.target.value)} className="mt-1 block w-full" required />
                                        <InputError message={errors.full_name} className="mt-2" />
                                    </div>
                                    <div>
                                        <InputLabel htmlFor="nim" value="NIM" />
                                        <TextInput id="nim" value={data.nim} onChange={e => setData('nim', e.target.value)} className="mt-1 block w-full" required />
                                        <InputError message={errors.nim} className="mt-2" />
                                    </div>
                                    <div>
                                        <InputLabel htmlFor="faculty" value="Fakultas" />
                                        <TextInput id="faculty" value={data.faculty} onChange={e => setData('faculty', e.target.value)} className="mt-1 block w-full" required />
                                        <InputError message={errors.faculty} className="mt-2" />
                                    </div>
                                    <div>
                                        <InputLabel htmlFor="department" value="Jurusan" />
                                        <TextInput id="department" value={data.department} onChange={e => setData('department', e.target.value)} className="mt-1 block w-full" required />
                                        <InputError message={errors.department} className="mt-2" />
                                    </div>
                                     <div>
                                        <InputLabel htmlFor="year_in" value="Angkatan (Tahun Masuk)" />
                                        <TextInput id="year_in" type="number" value={data.year_in} onChange={e => setData('year_in', e.target.value)} className="mt-1 block w-full" required />
                                        <InputError message={errors.year_in} className="mt-2" />
                                    </div>
                                    <div>
                                        <InputLabel htmlFor="phone_number" value="Nomor Telepon/WA" />
                                        <TextInput id="phone_number" value={data.phone_number} onChange={e => setData('phone_number', e.target.value)} className="mt-1 block w-full" required />
                                        <InputError message={errors.phone_number} className="mt-2" />
                                    </div>
                                     <div className="md:col-span-2">
                                        <InputLabel htmlFor="email" value="Email" />
                                        <TextInput id="email" type="email" value={data.email} onChange={e => setData('email', e.target.value)} className="mt-1 block w-full" required />
                                        <InputError message={errors.email} className="mt-2" />
                                    </div>
                                    <div className="md:col-span-2">
                                        <InputLabel htmlFor="reason" value="Alasan Bergabung dengan UKM" />
                                        <textarea id="reason" value={data.reason} onChange={e => setData('reason', e.target.value)} className="mt-1 block w-full border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required></textarea>
                                        <InputError message={errors.reason} className="mt-2" />
                                    </div>
                                </div>

                                <div className="mt-8 text-right">
                                    <PrimaryButton disabled={processing}>
                                        Daftar Sekarang
                                    </PrimaryButton>
                                </div>
                            </form>
                        ) : null}
                    </div>
                </div>
            </div>
        </PublicLayout>
    );
}