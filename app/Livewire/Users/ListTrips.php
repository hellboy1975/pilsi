<?php

namespace App\Livewire\Users;

use App\Models\Visit;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListTrips extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    /* TODO: add a filter to this to show only the current users visits
    */
    public function table(Table $table): Table
    {
        return $table
            ->query(Visit::query())
            ->columns([
                TextColumn::make('start_date')
                ->date(),
                TextColumn::make('cave.name'),
                TextColumn::make('trip.name'),
                TextColumn::make('party_leader'),
                TextColumn::make('duration')->suffix(' hours'),
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
