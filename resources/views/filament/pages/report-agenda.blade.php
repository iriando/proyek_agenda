<x-filament::page>
    <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-4">Laporan Jumlah Peserta per Agenda</h2>

        <table class="w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Judul Agenda</th>
                    <th class="border p-2">Tanggal pelaksanaan</th>
                    <th class="border p-2">Jumlah Peserta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->getAgendas() as $agenda)
                    <tr class="border">
                        <td class="border p-2">
                            <a href="{{ route('filament.admin.pages.detail-report', $agenda->id) }}" class="text-blue-600 hover:underline">
                                {{ $agenda->judul }}
                            </a>
                        </td>
                        <td class="border p-2 text-center">{{ date('d M Y', strtotime($agenda->tanggal_pelaksanaan)) }}
                        </td>
                        <td class="border p-2 text-center">{{ $agenda->peserta_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament::page>
