<x-filament::page>
    <div class="bg-white p-4 rounded-lg shadow">

        {{-- TABEL DAFTAR PESERTA --}}
        <h3 class="text-lg font-bold mb-2">Daftar Peserta</h3>
        <table class="w-full border-collapse border border-gray-300 mb-6">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">NIP</th>
                    <th class="border p-2">Instansi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agenda->peserta as $peserta)
                    <tr class="border">
                        <td class="border p-2">{{ $peserta->nama }}</td>
                        <td class="border p-2">{{ $peserta->nip }}</td>
                        <td class="border p-2">{{ $peserta->instansi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>

        {{-- TABEL UNTUK PERTANYAAN MULTIPLE CHOICE & RATING --}}
        <h3 class="text-lg font-bold mb-2">Laporan survey</h3>
        <table class="w-full border-collapse border border-gray-300 mb-6">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">Pertanyaan</th>
                    <th class="border p-2">Jawaban</th>
                    <th class="border p-2 text-center">Jumlah Respon</th>
                    <th class="border p-2 text-center">Progress</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surveyResults as $question)
                    @if($question->type !== 'text')
                        @php
                            $totalResponses = $question->response->sum('total');
                        @endphp
                        @foreach ($question->response as $response)
                            @php
                                $percentage = ($totalResponses > 0) ? round(($response->total / $totalResponses) * 100, 2) : 0;
                            @endphp
                            <tr class="border">
                                <td class="border p-2">{{ $question->question }}</td>
                                <td class="border p-2">
                                    @if($question->type === 'rating')
                                        @for ($i = 0; $i < $response->answer; $i++)
                                            ⭐
                                        @endfor
                                    @else
                                        {{ $response->answer }}
                                    @endif
                                </td>
                                <td class="border p-2 text-center">{{ $response->total }}</td>
                                <td class="border p-2 text-center">
                                    <div class="w-full bg-gray-200 rounded-full h-4 relative">
                                        <div class="bg-blue-500 h-4 rounded-full" style="width: {{ $percentage }}%; min-width: 5%; background-color: #2563eb;">
                                        </div>
                                        <span class="absolute right-2 top-0 bottom-0 flex items-center text-xs font-bold text-white px-2">
                                            {{ $percentage }}%
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
        <br>

        {{-- CARD UNTUK PERTANYAAN DENGAN JAWABAN TEKS --}}
        <div class="bg-white p-4 rounded-lg shadow space-y-6">
            @foreach ($surveyResults as $question)
                @if($question->type === 'text')
                    <div class="mb-4">
                        <h3 class="text-lg font-bold mb-2">{{ $question->question }}</h3> {{-- Judul pertanyaan --}}

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($question->response as $response)
                                <div class="bg-white shadow-md rounded-lg p-4 border">
                                    <p class="text-gray-700">{{ $response->answer }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>

    <div class="text-center mt-4">
        <a href="{{ route('filament.admin.pages.report-agenda') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</x-filament::page>
