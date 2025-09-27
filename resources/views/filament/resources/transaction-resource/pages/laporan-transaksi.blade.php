<x-filament-panels::page>
    <form wire:submit.prevent="cetakLaporan">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                Cetak Laporan
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>