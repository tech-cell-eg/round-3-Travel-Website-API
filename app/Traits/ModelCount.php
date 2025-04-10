<?php

namespace App\Traits;


trait ModelCount
{
    // scope method to filter queries
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
