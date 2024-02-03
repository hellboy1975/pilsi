<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SqueezeResource\Pages;
use App\Filament\Resources\SqueezeResource\RelationManagers\AttemptsRelationManager;
use App\Models\Squeeze;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SqueezeResource extends Resource
{
    protected static ?string $model = Squeeze::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $navigationGroup = 'Manage';

    protected static ?int $navigationSort = 4;

    /**
     * Get the navigation badge for the resource.
     */
    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Squeeze details')
                    ->columns([
                        'default' => 1,
                        'xl' => 2,
                    ])
                    ->schema([
                        Infolists\Components\TextEntry::make('name'),
                        Infolists\Components\TextEntry::make('cave.name'),
                        Infolists\Components\TextEntry::make('pilsi')
                            ->label('PiLSi'),
                        Infolists\Components\TextEntry::make('description'),
                        Infolists\Components\ImageEntry::make('main_picture')
                            ->columnSpanFull(),
                    ]),

            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns([
                'default' => 1,
                'xl' => 2,
            ])
            ->schema([
                Forms\Components\Section::make('Squeeze Details')
                    ->columns([
                        'default' => 1,
                        'xl' => 2,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('pilsi')
                            ->label('PiLSi')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('cave_id')
                            ->relationship('cave', 'name'),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Added by')
                            ->default(auth()->user()->id),
                        Forms\Components\MarkdownEditor::make('description')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('main_picture')
                            ->directory('squeezePhotos')
                            ->columnSpanFull()
                            ->image(),
                    ]),
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
                
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Tables\Actions\ViewAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AttemptsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSqueezes::route('/'),
            'create' => Pages\CreateSqueeze::route('/create'),
            'edit' => Pages\EditSqueeze::route('/{record}/edit'),
            'view' => Pages\ViewSqueeze::route('/{record}'),
        ];
    }
}
