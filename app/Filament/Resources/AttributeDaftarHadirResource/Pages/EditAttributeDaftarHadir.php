<?php

namespace App\Filament\Resources\AttributeDaftarHadirResource\Pages;

use App\Filament\Resources\AttributeDaftarHadirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttributeDaftarHadir extends EditRecord
{
    protected static string $resource = AttributeDaftarHadirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
