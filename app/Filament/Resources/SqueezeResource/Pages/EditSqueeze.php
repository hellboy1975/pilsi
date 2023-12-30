<?php

namespace App\Filament\Resources\SqueezeResource\Pages;

use App\Filament\Resources\SqueezeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSqueeze extends EditRecord
{
    protected static string $resource = SqueezeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
