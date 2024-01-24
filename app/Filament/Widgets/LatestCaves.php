<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CaveResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCaves extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                CaveResource::getEloquentQuery()
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('region.name')
                    ->sortable(),
            ]);
    }
}
