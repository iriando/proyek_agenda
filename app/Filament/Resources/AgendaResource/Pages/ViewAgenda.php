<?php

namespace App\Filament\Resources\AgendaResource\Pages;

use Filament\Actions;
use App\Models\Peserta;
use Filament\Actions\Action;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\AgendaResource;

class ViewAgenda extends ViewRecord
{
    protected static string $resource = AgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
        $userId = Auth::id();
        $user = Auth::user();
        $agendaId = $this->record->id;

            // Cek apakah user memiliki role selain "peserta"
        if (!$user->hasRole('peserta')) {
            return [];
        }

        // Cek apakah user sudah terdaftar dalam agenda ini
        $isRegistered = Peserta::where('user_id', $userId)
                        ->where('agenda_id', $agendaId)
                        ->exists();

        $actions = [];
        // munculkan tombol daftar kalo belum terdaftar
        if (!$isRegistered) {
            // $actions[] = Action::make('Daftar')
            //     ->color('warning')
            //     ->action(fn () => $this->daftarkanPeserta())
            //     ->hidden(fn () => $this->record->status === 'Selesai');
        }

        // Tampilkan tombol "Isi Survei" jika pengguna sudah terdaftar dan survei tersedia
        if ($isRegistered && $this->record->survey->is_active == 1) {
            $actions[] = Action::make('isi_survei')
                ->label('Isi Survei')
                ->color('success')
                ->icon('heroicon-o-document-text')
                ->url(route('filament.pages.submit-survey', ['survey' => $this->record->survey->id]));
        }

        return $actions;
    }

    public function daftarkanPeserta()
    {
        $userId = Auth::id();
        $agendaId = $this->record->id;
        Peserta::create([
            'user_id' => $userId,
            'agenda_id' => $agendaId,
        ]);
    }

    public function getTitle(): string
    {
        return 'Lihat kegiatan';
    }

}
