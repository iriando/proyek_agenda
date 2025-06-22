<?php

namespace App\Filament\Resources\AttributeDaftarHadirResource\Pages;

use App\Filament\Resources\AttributeDaftarHadirResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAttributeDaftarHadir extends ViewRecord
{
    protected static string $resource = AttributeDaftarHadirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
