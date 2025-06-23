<?php

namespace App\Filament\Resources\AttributeDaftarHadirResource\Pages;

use App\Filament\Resources\AttributeDaftarHadirResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttributeDaftarHadir extends CreateRecord
{
    protected static string $resource = AttributeDaftarHadirResource::class;

    public function getTitle(): string
    {
        return 'Buat Pengaturan Daftar Hadir';
    }
}
