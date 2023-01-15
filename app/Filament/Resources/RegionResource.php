<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionResource\Pages;
use App\Filament\Resources\RegionResource\RelationManagers;
use App\Models\Region;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 1;

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
                Forms\Components\TextInput::make('country_code')
                    ->required()
                    ->maxLength(2),
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
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CavesRelationManager::class,
            RelationManagers\TripsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }
}
