<x-filament-panels::page>
    <div class="space-y-8">
        <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Selamat Datang, {{ $user->name }}!</h1>
            <p class="mt-1 text-gray-600 dark:text-gray-300">Berikut adalah ringkasan aktivitas dan informasi penting untukmu.</p>
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
            
            </div>
    </div>
</x-filament-panels::page>