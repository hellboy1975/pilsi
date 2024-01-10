<?php

namespace App\Filament\Resources\CaveResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VisitsRelationManager extends RelationManager
{
    protected static string $relationship = 'visits';

    protected static ?string $recordTitleAttribute = 'start_date';

    public function form(Form $form): Form
    {
        return $form
            ->columns([
                'default' => 1,
                'xl' => 2,
            ])
            ->schema([
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\TextInput::make('party_leader')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('trip_id')
                    ->relationship('trip', 'name'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Added by')
                    ->default(auth()->user()->id),
                Forms\Components\MarkdownEditor::make('notes')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('start_date')
                    ->searchable()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('party_leader')
                    ->searchable()
                    ->sortable()
                    ->visibleFrom('md'),
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
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ]);
    }
}
