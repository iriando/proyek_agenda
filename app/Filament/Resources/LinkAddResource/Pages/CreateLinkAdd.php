<?php

namespace App\Filament\Resources\LinkAddResource\Pages;

use App\Filament\Resources\LinkAddResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLinkAdd extends CreateRecord
{
    protected static string $resource = LinkAddResource::class;

    public function getTitle(): string
    {
        return 'Buat Link Tambahan';
    }
}
