<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manage';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Content')
                            ->schema([
                                TitleWithSlugInput::make(
                                    fieldTitle: 'title', // The name of the field in your model that stores the title.
                                    fieldSlug: 'slug', // The name of the field in your model that will store the slug.
                                ),
                                TextInput::make('description')
                                    ->required(),
                                MarkdownEditor::make('content')
                                    ->required(),
                                FileUpload::make('featured_image')
                                    ->columnSpanFull()
                                    ->directory('postImages')
                                    ->disk('public')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ]),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),
                Group::make()
                    ->schema([
                        Section::make('Info')->schema([
                            Select::make('post_type')
                                ->default('news')
                                ->options([
                                'news' => 'News',
                                'page' => 'Page',
                                'journal' => 'Journal',
                                ])
                                ->live(),
                            Select::make('status')
                                ->options([
                                'draft' => 'Draft',
                                'reviewing' => 'Reviewing',
                                'published' => 'Published',
                                'rejected' => 'Rejected',
                                ])
                                ->default('draft'),
                            Select::make('user_id')
                                ->relationship('author', 'name')
                                ->label('Author')
                                ->default(auth()->user()->id),
                            Select::make('parent_id')
                                ->relationship('parent', 'title')
                                ->label('Parent Page')
                                ->visible(fn (Get $get): bool => ! $get('post_type') == 'page'),
                            DateTimePicker::make('published_at')
                                ->default(now()),
                        ])
                            ->columnSpan(['lg' => 1]),
                    ]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('post_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'news' => 'warning',
                        'page' => 'success',
                        'journal' => 'danger',
                    }),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'reviewing' => 'warning',
                        'published' => 'success',
                        'rejected' => 'danger',
                    }),
                TextColumn::make('author.name'),
                TextColumn::make('published_at')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
