<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class PesertaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $agendaId;

    public function __construct($agendaId)
    {
        $this->agendaId = $agendaId;
    }

    public function collection()
    {
        return Peserta::where('agenda_id', $this->agendaId)->select([
            'nama',
            'nip',
            'instansi',
            'jabatan',
            'no_hp',
            'email',
            'harapan',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIP',
            'Instansi',
            'Jabatan',
            'No HP',
            'Email',
            'Harapan',
        ];
    }

    public function map($peserta): array
    {
        return [
            $peserta->nama,
            "'" . $peserta->nip, // Petik satu supaya Excel anggap sebagai teks
            $peserta->instansi,
            $peserta->jabatan,
            $peserta->no_hp,
            $peserta->email,
            $peserta->harapan,
        ];
    }

}
