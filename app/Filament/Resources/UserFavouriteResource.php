<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserFavouriteResource\Pages;
use App\Models\Cave;
use App\Models\Region;
use App\Models\Squeeze;
use App\Models\UserFavourite;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class UserFavouriteResource extends Resource
{
    protected static ?string $model = UserFavourite::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $modelLabel = 'Favourites';

    /**
     * Get the navigation badge for the resource.
     */
    public static function getNavigationBadge(): ?string
    {
        return number_format(self::getEloquentQuery()->where('user_id', Auth::id())->count());
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                self::getEloquentQuery()->where('user_id', Auth::id()),
            )
            ->columns([
                TextColumn::make('entity_type')
                    ->label('Type')
                    ->badge()
                    ->state(function (UserFavourite $favourite): string {

                        return match ($favourite->entity_type) {
                            'App\Models\Cave' => 'Cave',
                            'App\Models\Region' => 'Region',
                            'App\Models\Squeeze' => 'Squeeze',
                            default => 'Cave',
                        };
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Cave' => 'primary',
                        'Region' => 'info',
                        'Squeeze' => 'success',
                        default => 'primary',
                    }),
                TextColumn::make('entity.name')
                    ->label('Name')
                    ->searchable(),
            ])
            ->recordUrl(
                function (UserFavourite $record): string {
                    if ($record->entity_type === Cave::class) {
                        return route('filament.admin.resources.caves.view', ['record' => $record]);
                    } else if ($record->entity_type === Region::class) {
                        return route('filament.admin.resources.regions.view', ['record' => $record]);
                    } else if ($record->entity_type === Squeeze::class) {
                        return route('filament.admin.resources.squeezes.view', ['record' => $record]);
                    }
                }
            )
            ->filters([
                SelectFilter::make('entity_type')
                    ->label('Type')
                    ->options([
                        'App\Models\Cave' => 'Cave',
                        'App\Models\Region' => 'Region',
                        'App\Models\Squeeze' => 'Squeeze',
                    ]),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUserFavourites::route('/'),
        ];
    }
}
