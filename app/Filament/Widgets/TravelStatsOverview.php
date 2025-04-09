<?php

namespace App\Filament\Widgets;

use App\Models\Destination;
use App\Models\TourCategory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TravelStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Destinations', Destination::count())
                ->icon('heroicon-o-map')
                ->color('primary'),
                
            Stat::make('Total Tour Categories', TourCategory::count())
                ->icon('heroicon-o-tag')
                ->color('primary')
                ->description('All available tour categories')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}