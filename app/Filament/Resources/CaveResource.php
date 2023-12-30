<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaveResource\Pages;
use App\Models\Cave;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\CaveResource\RelationManagers\SqueezesRelationManager;
Use App\Filament\Resources\CaveResource\Pages\ViewCave;
use App\Filament\Resources\CaveResource\RelationManagers\VisitsRelationManager;
use Filament\Tables\Actions\Action;

class CaveResource extends Resource
{
    protected static ?string $model = Cave::class;

    protected static ?string $navigationIcon = 'heroicon-o-stop';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 3;

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
                Forms\Components\Select::make('region_id')
                    ->relationship('region', 'name'),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(['default' => 2]),
                Forms\Components\FileUpload::make('main_picture'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('region.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('region')->relationship('region', 'name')
            ])
            ->actions([
                Action::make('view')
                    ->url(fn (Cave $record): string => route('filament.resources.caves.view', $record)),
                Action::make('edit')
                    ->url(fn (Cave $record): string => route('filament.resources.caves.edit', $record))
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SqueezesRelationManager::class,
            VisitsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCaves::route('/'),
            'create' => Pages\CreateCave::route('/create'),
            'edit' => Pages\EditCave::route('/{record}/edit'),
            'view' => Pages\ViewCave::route('/{record}'),
        ];
    }
}
