<?php

namespace App\Filament\Resources\LinkAddResource\Pages;

use App\Filament\Resources\LinkAddResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLinkAdds extends ListRecords
{
    protected static string $resource = LinkAddResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
