<x-filament-panels::page>
    <form wire:submit.prevent="generateSurat">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                Generate Surat (PDF)
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>