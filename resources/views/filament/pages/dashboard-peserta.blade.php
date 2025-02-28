<x-filament::page>
    <div class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto">

            {{-- Header dengan Tombol --}}
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Agenda Kegiatan Mendatang</h2>

                <a href="{{ url('/admin/kegiatan-diikuti') }}"
                class="px-4 py-2 bg-green-600 text-black font-semibold rounded-md shadow-md hover:bg-green-700 transition border border-green-700">
                    <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Agenda yang Diikuti
                </a>

            </div>

            {{-- Daftar Agenda --}}
            @if ($agendas->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">Belum ada agenda yang akan datang.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($agendas as $agenda)
                        <div class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4 dark:bg-gray-800">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $agenda->judul }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($agenda->tanggal_pelaksanaan)->format('d M Y') }} | {{ $agenda->deskripsi }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-filament::page>
