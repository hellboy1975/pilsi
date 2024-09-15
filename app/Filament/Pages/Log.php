<?php

namespace App\Filament\Pages;

use App\Livewire\CaveLogOverview;
use Filament\Pages\Page;

class Log extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationLabel = 'Cave Log';

    protected static string $view = 'filament.pages.log';

    protected function getHeaderWidgets(): array
    {
        return [
            CaveLogOverview::class,
        ];
    }
}
