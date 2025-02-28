<?php

namespace App\Filament\Pages;

use App\Models\Agenda;
use Filament\Pages\Page;

class KegiatanDiikuti extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-check';
    protected static ?string $slug = 'kegiatan-diikuti';
    protected static string $view = 'filament.pages.kegiatan-diikuti';


    public function getTitle(): string
    {
        return '';
    }

    public function getViewData(): array
    {
        return [
            'agendas' => Agenda::whereHas('peserta', function ($query) {
                $query->where('user_id', auth()->id()); // Hanya ambil kegiatan yang diikuti oleh user yang login
            })->get(),
        ];
    }
}
