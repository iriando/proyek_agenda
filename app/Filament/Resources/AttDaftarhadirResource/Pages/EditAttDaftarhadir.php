<?php

namespace App\Filament\Resources\AttDaftarhadirResource\Pages;

use App\Filament\Resources\AttDaftarhadirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttDaftarhadir extends EditRecord
{
    protected static string $resource = AttDaftarhadirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
