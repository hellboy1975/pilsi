<?php

namespace App\Livewire\Users;

use App\Models\Trip;
use App\Models\User;
use App\Models\UserTrip;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ListTrips extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    /* TODO: add a filter to this to show only the current users visits
    */
    public function table(Table $table): Table
    {
        return $table
            // TODO: in the query function should be some code that querys the user_trips table and filters by user id
            ->query(UserTrip::query()
                ->join('trips', 'user_trips.trip_id', '=', 'trips.id')
                ->where('user_trips.user_id', Auth::user()->id))
            ->columns([
                TextColumn::make('start_date')
                ->date(),
                TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.users.list-trips');
    }
}
