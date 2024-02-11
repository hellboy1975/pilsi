<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Awcodes\FilamentGravatar\Gravatar;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Manage';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Details')
                    ->columns([
                        'default' => 1,
                        'xl' => 2,
                    ])
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Display Name')
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->suffixIcon('heroicon-m-at-symbol')
                            ->maxLength(255),
                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->hiddenOn('edit')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('bio')
                            ->label('User Biography')
                            ->maxLength(5000)
                            ->columnSpanFull(),

                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make(fn ($record): string => $record->name)
                    ->columns([
                        'default' => 1,
                        'xl' => 2,
                    ])
                    ->schema([
                        Infolists\Components\ImageEntry::make('avatar')
                            ->defaultImageUrl(fn ($record): string => Gravatar::get(email: $record->email))
                            ->circular()
                            ->label(''),
                        Infolists\Components\TextEntry::make('bio')
                            ->markdown(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    ImageColumn::make('avatar')
                        ->defaultImageUrl(fn ($record): string => Gravatar::get(email: $record->email))
                        ->circular()
                        ->grow(false)
                        ->label(''),
                    TextColumn::make('name')
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('email')
                        ->searchable()
                        ->sortable(),
                ])
                    ->from('md'),
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('view')
                        ->url(fn (User $record): string => route('filament.admin.resources.users.view', $record))
                        ->icon('heroicon-m-eye'),
                    Action::make('edit')
                        ->url(fn (User $record): string => route('filament.admin.resources.users.edit', $record))
                        ->icon('heroicon-m-pencil'),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->label('Actions'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ClubsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }
}
