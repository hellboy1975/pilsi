<?php

namespace App\Filament\Resources;

use App\Filament\Forms\Components\LocalisedCountrySelect;
use App\Filament\Resources\RegionResource\Pages;
use App\Filament\Resources\RegionResource\RelationManagers;
use App\Models\Region;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action as ActionsAction;
use Filament\Tables\Table;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';

    protected static ?string $navigationGroup = 'Manage';

    protected static ?int $navigationSort = 1;

    /**
     * Get the navigation badge for the resource.
     */
    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Squeeze details')
                    ->columns([
                        'default' => 1,
                        'xl' => 2,
                    ])
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('code'),
                        TextEntry::make('country_code')
                            ->label('PiLSi'),
                        TextEntry::make('description')
                            ->columnSpanFull(),
                    ])
                    ->headerActions([
                        Action::make('Favourite')
                            ->action(function (Region $entity) {
                                User::toggleFavourite($entity);
                            })->icon(fn (Region $record): string => User::hasFavourite($record) ? 'heroicon-m-heart' : 'heroicon-o-heart'),
                    ]),

            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
                LocalisedCountrySelect::make('country_code')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(['default' => 2]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country_code'),
            ])
            ->actions([
                ActionsAction::make('view')
                    ->url(fn (Region $record): string => route('filament.admin.resources.regions.view', $record))
                    ->icon('heroicon-m-eye')
                    ->iconButton(),
                ActionsAction::make('edit')
                    ->url(fn (Region $record): string => route('filament.admin.resources.regions.edit', $record))
                    ->icon('heroicon-m-pencil')
                    ->iconButton(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CavesRelationManager::class,
            RelationManagers\TripsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
            'view' => Pages\ViewRegion::route('/{record}'),
        ];
    }
}
