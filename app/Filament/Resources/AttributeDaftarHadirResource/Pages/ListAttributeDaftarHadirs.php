<?php

namespace App\Filament\Resources\AttributeDaftarHadirResource\Pages;

use App\Filament\Resources\AttributeDaftarHadirResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttributeDaftarHadirs extends ListRecords
{
    protected static string $resource = AttributeDaftarHadirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Buat Pengaturan Daftar Hadir'),
        ];
    }
}
