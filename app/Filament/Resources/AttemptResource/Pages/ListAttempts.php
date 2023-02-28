<?php

namespace App\Filament\Resources\AttemptResource\Pages;

use App\Filament\Resources\AttemptResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttempts extends ListRecords
{
    protected static string $resource = AttemptResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
