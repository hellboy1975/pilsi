<?php

namespace App\Filament\Resources\SqueezeResource\Pages;

use App\Filament\Resources\SqueezeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSqueezes extends ListRecords
{
    protected static string $resource = SqueezeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
