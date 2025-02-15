<?php

namespace App\Filament\Resources\MateriResource\Pages;

use App\Filament\Resources\MateriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMateri extends ViewRecord
{
    protected static string $resource = MateriResource::class;

    public function getTitle(): string
    {
        return 'Lihat materi';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
