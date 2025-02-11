<?php

namespace App\Filament\Resources\AgendaResource\Pages;

use Filament\Actions;
use App\Models\Peserta;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\AgendaResource;

class ViewAgenda extends ViewRecord
{
    protected static string $resource = AgendaResource::class;

    protected function getHeaderActions(): array
    {
        $userId = Auth::id();
        $agendaId = $this->record->id;

        // Cek apakah user sudah terdaftar dalam agenda ini
        $isRegistered = Peserta::where('user_id', $userId)
                        ->where('agenda_id', $agendaId)
                        ->exists();

        return $isRegistered ? [] : [
            // Jika sudah terdaftar, jangan tampilkan tombol
            Action::make('Daftarkan')
                ->color('warning')
                ->action(fn () => $this->daftarkanPeserta()),
        ];
    }

    public function daftarkanPeserta()
    {
        $userId = Auth::id();
        $agendaId = $this->record->id;

        // Simpan peserta baru
        Peserta::create([
            'user_id' => $userId,
            'agenda_id' => $agendaId,
        ]);
    }
}
