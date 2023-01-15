<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripResource\Pages;
use App\Filament\Resources\TripResource\RelationManagers;
use App\Models\Trip;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationGroup = 'Data';

    protected static ?string $navigationIcon = 'heroicon-o-trending-up';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(['default' => 2]),
                Forms\Components\TextInput::make('trip_leader')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('region_id')
                    ->relationship('region', 'name'),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label("Added by")
                    ->default(auth()->user()->id),
                Forms\Components\RichEditor::make('notes')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(['default' => 2])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('trip_leader')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('region.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('region')->relationship('region', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }    
}
