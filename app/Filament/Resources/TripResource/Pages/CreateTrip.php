<?php

namespace App\Filament\Resources\TripResource\Pages;

use App\Filament\Forms\Components\LocalisedCountrySelect;
use App\Filament\Resources\TripResource;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\CreateRecord;

class CreateTrip extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = TripResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }

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
                ]),
            Step::make('Dates')
                ->description('When did you go?')
                ->schema([
                    DatePicker::make('start_date')
                        ->required()
                        ->live()
                        ->default(now()),
                    DatePicker::make('end_date')
                        ->required()
                        ->minDate(function (Get $get) {
                            return Carbon::parse($get('start_date'));
                        })
                        ->default(now()),
                ]),
            Step::make('Who')
                ->description('Who as on the trip?')
                ->schema([
                    Select::make('trip_leader_id')
                        ->relationship('user', 'name')
                        ->searchable('name')
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set) {
                            $set('trip_leader', User::find($get('trip_leader_id'))->name ?? '');
                        })
                        ->default(auth()->user()->id),
                    TextInput::make('trip_leader'),
                ]),
            Step::make('About')
                ->description('Trip details?')
                ->schema([
                    TextInput::make('name')
                        ->label('Trip name')
                        ->required()
                        ->maxLength(255),
                ]),
        ];
    }
}
