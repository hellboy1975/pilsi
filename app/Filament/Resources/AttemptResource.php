<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttemptResource\Pages;
use App\Filament\Resources\AttemptResource\RelationManagers;
use App\Models\Attempt;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttemptResource extends Resource
{
    protected static ?string $model = Attempt::class;

    protected static ?string $navigationIcon = 'heroicon-o-upload';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('squeeze_id')
                    ->relationship('squeeze', 'name'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name'),
                Forms\Components\DateTimePicker::make('date')
                    ->required()
                    ->withoutSeconds()
                    ->maxDate(now()),
                Forms\Components\Radio::make('success')
                    ->label('Did you make it through?')
                    ->boolean()
                    ->required(),
                Forms\Components\RichEditor::make('notes')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(['default' => 2]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->datetime('M d, Y')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('success')
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\TextColumn::make('squeeze.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('squeeze.pilsi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
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
            'index' => Pages\ListAttempts::route('/'),
            'create' => Pages\CreateAttempt::route('/create'),
            'edit' => Pages\EditAttempt::route('/{record}/edit'),
        ];
    }    
}
