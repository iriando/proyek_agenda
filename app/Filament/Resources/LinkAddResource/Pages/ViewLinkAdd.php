<?php

namespace App\Filament\Resources\LinkAddResource\Pages;

use App\Filament\Resources\LinkAddResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLinkAdd extends ViewRecord
{
    protected static string $resource = LinkAddResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
