<x-filament-panels::page>
    <div class="space-y-8">
        <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Selamat Datang, {{ $user->name }}!</h1>
            <p class="mt-1 text-gray-600 dark:text-gray-300">Berikut adalah ringkasan aktivitas dan informasi penting untukmu.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Status Keanggotaan</h2>
                <p class="mt-1 text-3xl font-semibold text-green-600">Aktif</p>
            </div>
            <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Poin Keaktifan</h2>
                <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">150 Poin</p>
            </div>
            <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Kegiatan Diikuti</h2>
                <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">5 Acara</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 space-y-6">
                <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
                    <h3 class="font-semibold text-gray-900 dark:text-white">Akses Cepat</h3>
                    <ul class="mt-4 space-y-3">
                        <li><a href="{{ \App\Filament\Pages\Portfolio::getUrl() }}" class="flex items-center gap-3 text-sm font-medium text-gray-600 hover:text-amber-600 dark:text-gray-300">
                            <x-heroicon-o-user-circle class="w-5 h-5"/> Bangun Portofolio
                        </a></li>
                        <li><a href="{{ \App\Filament\Pages\Absensi::getUrl() }}" class="flex items-center gap-3 text-sm font-medium text-gray-600 hover:text-amber-600 dark:text-gray-300">
                            <x-heroicon-o-qr-code class="w-5 h-5"/> Lakukan Absensi
                        </a></li>
                        <li><a href="{{ \Filament\Pages\Auth\EditProfile::getUrl() }}" class="flex items-center gap-3 text-sm font-medium text-gray-600 hover:text-amber-600 dark:text-gray-300">
                            <x-heroicon-o-cog-6-tooth class="w-5 h-5"/> Edit Profil Saya
                        </a></li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-2 p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
                <h3 class="font-semibold text-gray-900 dark:text-white">Kegiatan Mendatang</h3>
                <div class="mt-4 space-y-4">
                    @forelse($upcomingEvents as $event)
                        <div class="p-4 border rounded-lg dark:border-gray-700">
                            <p class="font-semibold">{{ $event->title }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($event->start_date)->isoFormat('dddd, D MMMM YYYY') }} - {{ $event->location }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Belum ada kegiatan yang akan datang.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>