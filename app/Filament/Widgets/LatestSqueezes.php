<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\SqueezeResource;
use App\Models\Squeeze;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestSqueezes extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                SqueezeResource::getEloquentQuery()
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cave.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pilsi')
                    ->sortable(),
            ])
            ->recordUrl(
                fn (Squeeze $record): string => route('filament.admin.resources.squeezes.view', ['record' => $record]),
            );

    }
}
