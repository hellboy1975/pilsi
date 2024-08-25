<?php

namespace App\Filament\Resources\TripResource\Pages;

use App\Filament\Forms\Components\LocalisedCountrySelect;
use App\Filament\Resources\TripResource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;

class CreateTrip extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = TripResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Region')
                ->description('Which region is the trip to?')
                ->schema([
                    LocalisedCountrySelect::make('country')
                        //TODO: use local
                        ->default('AU'),
                    Select::make('region_id')
                        ->relationship('region', 'name')
                        ->required(),
                ])
        ];
    }
}
