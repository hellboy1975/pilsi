<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttemptResource\Pages;
use App\Models\Attempt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AttemptResource extends Resource
{
    protected static ?string $model = Attempt::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';

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
                Forms\Components\Select::make('visit_id')
                    ->relationship('visit', 'start_date'),
                Forms\Components\TimePicker::make('date')
                    ->required()
                    ->seconds(false)
                    ->default(now()),
                Forms\Components\Toggle::make('success')
                    ->label('Did you make it through?')
                    ->required(),
                Forms\Components\MarkdownEditor::make('notes')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('success')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
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
                Tables\Actions\EditAction::make()->iconButton(),
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
