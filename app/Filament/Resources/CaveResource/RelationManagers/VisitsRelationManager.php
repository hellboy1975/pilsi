<?php

namespace App\Filament\Resources\CaveResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitsRelationManager extends RelationManager
{
    protected static string $relationship = 'visits';

    protected static ?string $recordTitleAttribute = 'start_date';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('start_date')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_date')
                    ->required(),
                Forms\Components\TextInput::make('party_leader')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('trip_id')
                    ->relationship('trip', 'name'),
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
                Tables\Columns\TextColumn::make('start_date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('party_leader')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('trip.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
