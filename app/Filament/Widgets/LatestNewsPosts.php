<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestNewsPosts extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PostResource::getEloquentQuery()
                    ->where('post_type', 'news')
                    ->where('status', 'published')
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('published_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->description(fn (Post $record): string => $record->description),
                Tables\Columns\TextColumn::make('author.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->since()
                    ->sortable(),
            ])
            ->recordUrl(
                fn (Post $record): string => route('filament.admin.resources.posts.view', ['record' => $record]),
            )
            ->heading('Latest PiLSi News');
    }
}
