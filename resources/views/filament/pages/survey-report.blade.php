<x-filament::page>
    <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-4 text-center">Laporan Survey: {{ $agenda->name }}</h2>

        @if (count($surveyResults) > 0)
            @foreach ($surveyResults as $question)
                <div class="mb-4">
                    <h3 class="text-md font-semibold">{{ $question->question }}</h3>

                    @php
                        $totalResponses = $question->answer->sum('total'); // Total semua jawaban
                    @endphp

                    @foreach ($question->answer as $response)
                        @php
                            // Menghitung persentase yang lebih akurat
                            $percentage = ($totalResponses > 0) ? round(($response->total / $totalResponses) * 100, 2) : 0;
                        @endphp

                        <div class="mb-2">
                            <span class="text-sm font-medium">
                                {{ $response->answer }} ({{ $response->total }} respon) - {{ $percentage }}%
                            </span>
                            <div class="w-full bg-gray-300 rounded-full h-6 relative">
                                <div class="h-6 rounded-full text-white text-xs font-bold flex items-center justify-center"
                                    style="width: {{ $percentage }}%; min-width: 5%; background-color: #2563eb;">
                                    {{ $percentage }}%
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

        @else
            <p class="text-center text-gray-500">Tidak ada data survei untuk agenda ini.</p>
        @endif
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('filament.admin.pages.report-agenda') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</x-filament::page>
