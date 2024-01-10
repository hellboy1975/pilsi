<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitResource\Pages;
use App\Models\Visit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
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
                Forms\Components\Select::make('cave_id')
                    ->relationship('cave', 'name'),
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('start_date')
                    ->searchable()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cave.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('trip.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('party_leader')
                    ->searchable()
                    ->sortable()
                    ->visibleFrom('md'),
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
            'index' => Pages\ListVisits::route('/'),
            'create' => Pages\CreateVisit::route('/create'),
            'edit' => Pages\EditVisit::route('/{record}/edit'),
        ];
    }
}
