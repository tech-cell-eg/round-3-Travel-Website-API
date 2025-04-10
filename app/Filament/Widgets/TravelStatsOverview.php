<?php

namespace App\Filament\Widgets;

use App\Models\Tour;
use App\Models\User;
use App\Models\Extra;
use App\Models\Feature;
use App\Models\TourReview;
use App\Models\Destination;
use App\Models\Reservation;
use App\Models\Testimonial;
use App\Models\TourCategory;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TravelStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Destinations', Destination::count())
                ->icon('heroicon-o-map-pin')
                ->color('primary'),

            Stat::make('Total Tour Categories', TourCategory::count())
                ->icon('heroicon-o-tag')
                ->color('primary'),

            Stat::make('Total Tours', Tour::count())
                ->icon('heroicon-o-map')
                ->color('primary'),

            Stat::make('Total Features', Feature::count())
                ->icon('heroicon-o-star')
                ->color('primary'),

            Stat::make('Total Users', User::count())
                ->icon('heroicon-o-user')
                ->color('primary'),

            Stat::make('Total Reservations', Reservation::count())
                ->icon('heroicon-o-ticket')
                ->color('primary'),
            
            Stat::make('Total Reviews', TourReview::count())
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->color('primary'),

            Stat::make('Total Testimonials', Testimonial::count())
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->color('primary'),

            Stat::make('Total Extras', Extra::count())
                ->icon('heroicon-o-ellipsis-horizontal')
                ->color('primary'),

            
        ];
    }
}
