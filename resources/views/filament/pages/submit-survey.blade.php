<x-filament::page>
    <h1 class="text-2xl font-bold mb-4">Isi Survei</h1>

    @if (session()->has('success'))
        <div class="text-green-600 bg-green-100 p-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="text-red-600 bg-red-100 p-2 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if (!isset($questions) || $questions->isEmpty())
        <p>Tidak ada survei aktif saat ini.</p>
    @else
        <form wire:submit.prevent="submit">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-4">
                Kirim Jawaban
            </x-filament::button>
        </form>
    @endif
</x-filament::page>
