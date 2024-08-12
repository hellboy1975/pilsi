<?php

namespace App\Filament\Resources\CaveResource\Pages;

use App\Filament\Resources\CaveResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCaves extends ListRecords
{
    protected static string $resource = CaveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
