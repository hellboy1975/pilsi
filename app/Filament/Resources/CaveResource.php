<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaveResource\Pages;
use App\Filament\Resources\CaveResource\RelationManagers\SqueezesRelationManager;
use App\Filament\Resources\CaveResource\RelationManagers\VisitsRelationManager;
use App\Models\Cave;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Components\Actions\Action as ActionsAction;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CaveResource extends Resource
{
    protected static ?string $model = Cave::class;

    protected static ?string $navigationIcon = 'heroicon-o-stop';

    protected static ?string $navigationGroup = 'Manage';

    protected static ?int $navigationSort = 3;

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
                Infolists\Components\Section::make('Cave details')
                    ->description(fn (Cave $record): string => "Added by {$record->creator->name}")
                    ->columns([
                        'default' => 1,
                        'xl' => 2,
                    ])
                    ->schema([
                        Infolists\Components\TextEntry::make('name'),
                        Infolists\Components\TextEntry::make('code'),
                        Infolists\Components\TextEntry::make('region.name'),
                        Infolists\Components\TextEntry::make('region.name'),
                        Infolists\Components\ImageEntry::make('main_picture')
                            ->columnSpanFull(),
                    ])->headerActions([
                        ActionsAction::make('Favourite')
                            ->action(function (Cave $cave) {
                                User::toggleFavourite($cave);
                            })->icon(fn (Cave $record): string => User::hasFavourite($record) ? 'heroicon-m-heart' : 'heroicon-o-heart'),
                    ]),

            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Cave Details')
                    ->columns([
                        'default' => 1,
                        'xl' => 2,
                    ])
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
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('main_picture')
                            ->columnSpanFull()
                            ->directory('cavePhotos')
                            ->disk('public')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ]),
                    ]),
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
                    ->sortable()
                    ->visibleFrom('md'),
            ])
            ->filters([
                SelectFilter::make('region')->relationship('region', 'name'),
            ])
            ->actions([
                Action::make('view')
                    ->url(fn (Cave $record): string => route('filament.admin.resources.caves.view', $record))
                    ->icon('heroicon-m-eye')
                    ->iconButton(),
                Action::make('edit')
                    ->url(fn (Cave $record): string => route('filament.admin.resources.caves.edit', $record))
                    ->icon('heroicon-m-pencil')
                    ->iconButton(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SqueezesRelationManager::class,
            VisitsRelationManager::class,
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
