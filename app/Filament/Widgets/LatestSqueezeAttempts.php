<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\AttemptResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestSqueezeAttempts extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                AttemptResource::getEloquentQuery()
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('squeeze.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\IconColumn::make('success')
                    ->boolean()
                    ->alignCenter()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle'),
            ]);
    }
}
