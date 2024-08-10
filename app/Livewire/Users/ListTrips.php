<?php

namespace App\Livewire\Users;

use App\Models\UserVisit;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

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
                ->select(['visits.id', 'visits.start_date', 'trips.name as trip_name', 'visits.party_leader', 'visits.duration', DB::raw('CONCAT(caves.code, " ", caves.name) as cave_name')])
                ->join('visits', 'user_visits.visit_id', '=', 'visits.id')
                ->join('trips', 'visits.trip_id', '=', 'trips.id')
                ->join('caves', 'visits.cave_id', '=', 'caves.id')
                ->where('user_visits.user_id', Auth::user()->id))
            ->columns([
                TextColumn::make('start_date')
                    ->label('Date')
                    ->sortable()
                    ->date(),
                TextColumn::make('trip_name')
                    ->label('Trip')
                    ->sortable()
                    ->url(fn (UserVisit $record): string => route('filament.admin.resources.trips.view', ['record' => $record])),
                TextColumn::make('cave_name')
                    ->label('Cave')
                    ->sortable()
                    ->url(fn (UserVisit $record): string => route('filament.admin.resources.caves.view', ['record' => $record])),
                TextColumn::make('party_leader')
                    ->sortable(),
                TextColumn::make('duration')
                    ->label('Duration (hours)')
                    ->sortable()
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
