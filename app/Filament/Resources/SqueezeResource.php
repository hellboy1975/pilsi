<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SqueezeResource\Pages;
use App\Filament\Resources\SqueezeResource\RelationManagers;
use App\Models\Squeeze;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class SqueezeResource extends Resource
{
    protected static ?string $model = Squeeze::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pilsi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('cave_id')
                    ->relationship('cave', 'name'),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(['default' => 1]),
                Forms\Components\FileUpload::make('main_picture'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cave.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pilsi')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListSqueezes::route('/'),
            'create' => Pages\CreateSqueeze::route('/create'),
            'edit' => Pages\EditSqueeze::route('/{record}/edit'),
        ];
    }    
}
