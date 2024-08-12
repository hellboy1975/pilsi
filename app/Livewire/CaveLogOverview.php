<?php

namespace App\Livewire;

use App\Models\Cave;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CaveLogOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cave visits', User::visitCount()),
            Stat::make('Hours in caves', User::visitDuration()),
        ];
    }
}
