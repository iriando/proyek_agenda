<?php

namespace App\Filament\Resources\LinkAddResource\Pages;

use App\Filament\Resources\LinkAddResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLinkAdd extends EditRecord
{
    protected static string $resource = LinkAddResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
