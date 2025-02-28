<x-filament::page>
    <div class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Agenda yang Anda Ikuti</h2>

            @if ($agendas->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">Anda belum mengikuti agenda apa pun.</p>
            @else
                <!-- Agenda Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($agendas as $agenda)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            @if($agenda->poster)
                                <div class="flex justify-center w-full">
                                    <img src="{{ asset('storage/' . $agenda->poster) }}"
                                        class="h-36 object-cover object-center rounded-md mx-auto"
                                        alt="{{ $agenda->judul }}">
                                </div>
                            @else
                                <div class="flex justify-center w-full">
                                    <img src="{{ asset('uploads/agenda/default.jpg') }}"
                                        class="h-36 object-cover object-center rounded-md mx-auto"
                                        alt="Default Image">
                                </div>
                            @endif

                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $agenda->judul }}</h3>
                                <p class="text-sm text-gray-600">{{ $agenda->deskripsi }}</p>

                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="bi bi-calendar-event"></i>
                                    <span class="ml-2">
                                        {{ date('d M Y H:i', strtotime($agenda->tanggal_pelaksanaan)) }}
                                    </span>
                                </div>

                                <div class="mt-3">
                                    <a href="{{ $agenda->link }}" target="_blank"
                                    class="inline-block bg-green-600 text-blue text-sm font-medium px-4 py-2 rounded hover:bg-green-700 transition"> {{ Str::limit($agenda->zoomlink, 30, '...') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-filament::page>
