<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClubResource\Pages;
use App\Filament\Resources\ClubResource\RelationManagers;
use App\Models\Club;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClubResource extends Resource
{
    protected static ?string $model = Club::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('abbreviation')
                ->required()
                ->maxLength(25),
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('location')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('website')
                ->maxLength(255),   
            Forms\Components\RichEditor::make('about')
                ->required()
                ->maxLength(255)
                ->columnSpan(['default' => 2]),
            Forms\Components\FileUpload::make('logo_url'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('abbreviation')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->sortable()
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
            'index' => Pages\ListClubs::route('/'),
            'create' => Pages\CreateClub::route('/create'),
            'edit' => Pages\EditClub::route('/{record}/edit'),
        ];
    }    
}
