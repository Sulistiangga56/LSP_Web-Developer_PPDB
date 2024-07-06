<?php

namespace App\Filament\Resources\DataUserResource\Widgets;

use App\Models\DataUser;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Data Pendaftar', DataUser::count()),
        ];
    }
}
