<?php

namespace App\Filament\Resources\CaveResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SqueezesRelationManager extends RelationManager
{
    protected static string $relationship = 'squeezes';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pilsi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(['default' => 2]),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->default(auth()->user()->id),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('pilsi'),
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
