<?php

namespace App\Livewire\Users;

use App\Models\Trip;
use App\Models\User;
use App\Models\UserTrip;
use App\Models\UserVisit;
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
use Illuminate\Support\Facades\DB;

class ListTrips extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    /* TODO: add a filter to this to show only the current users visits
    */
    public function table(Table $table): Table
    {
        return $table
            ->query(UserVisit::query()
                ->select(['visits.id', 'visits.start_date', 'trips.name as trip_name', 'visits.party_leader', 'visits.duration', DB::raw('CONCAT(caves.code, " ", caves.name) as cave_name'), ])
                ->join('visits', 'user_visits.visit_id', '=', 'visits.id')
                ->join('trips', 'visits.trip_id', '=', 'trips.id')
                ->join('caves', 'visits.cave_id', '=', 'caves.id')
                ->where('user_visits.user_id', Auth::user()->id))
            ->columns([
                TextColumn::make('start_date')
                    ->label('Date')
                    ->date(),
                TextColumn::make('trip_name')
                    ->label('Trip'),
                TextColumn::make('cave_name')
                    ->label('Cave'),
                TextColumn::make('party_leader'),
                TextColumn::make('duration')
                   ->label('Duration (hours)')
                    ->alignRight(),
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
