<?php

namespace App\Filament\Resources\AgendaResource\Pages;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Filament\Notifications\Notification;
use App\Filament\Resources\AgendaResource;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action as ActionsAction;

class CreateAgenda extends CreateRecord
{
    protected static string $resource = AgendaResource::class;

    public function getTitle(): string
    {
        return 'Buat kegiatan';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        Notification::make()
            ->title('Agenda Baru!')
            ->body("Agenda '{$this->record->judul}' telah ditambahkan. Segera daftarkan diri anda!")
            ->success()
            ->actions([
                Action::make('lihat')
                    ->button()
                    ->url(route('filament.admin.resources.agendas.view', ['record' => $this->record->id]))
                    ->markAsRead(),
            ])
            ->sendToDatabase(User::all()); // Kirim ke semua user
    }
}
