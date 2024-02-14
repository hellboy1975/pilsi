<?php

namespace App\Filament\Resources\UserFavouriteResource\Pages;

use App\Filament\Resources\UserFavouriteResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUserFavourites extends ManageRecords
{
    protected static string $resource = UserFavouriteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
