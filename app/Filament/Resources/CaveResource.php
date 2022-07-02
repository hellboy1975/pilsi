<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaveResource\Pages;
use App\Models\Cave;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;

class CaveResource extends Resource
{
    protected static ?string $model = Cave::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                //
            ])
            ->filters([
                //
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
            'index' => Pages\ListCaves::route('/'),
            'create' => Pages\CreateCave::route('/create'),
            'edit' => Pages\EditCave::route('/{record}/edit'),
        ];
    }
}
