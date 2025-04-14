<?php

namespace App\Filters\Website;

use App\Helpers\QueryFilter;

class TourFilter extends QueryFilter
{
    public function search($search)
    {
        return $this->builder->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }

    public function tour_category_ids($ids)
    {
        return $this->builder->whereIn('tour_category_id', $ids);
    }

    public function destination_id($id)
    {
        return $this->builder->where('destination_id', $id);
    }

    public function languages($language)
    {
        return $this->builder->whereLike('languages',  "%{$language}%");
    }

    public function popular()
    {
        return $this->builder->where('type', 'popular');
    }

    public function trending()
    {
        return $this->builder->where('type', 'trending');
    }

    public function start_date($start)
    {
        $end = request('end_date');
        if ($end) {
            $duration = now()->parse($start)->diffInDays(now()->parse($end));
            return $this->builder->where('duration', $duration);
        }
        return $this->builder;
    }

    public function min_price($start)
    {
        $end = request('max_price');
        if ($end) {
            return $this->builder->whereBetween('initial_price', [$start, $end]);
        }
        return $this->builder;
    }

    public function rating($rating)
    {
        return $this->builder->whereHas('reviews', function ($query) use ($rating) {
            $query->select('tour_id')
                ->groupBy('tour_id')
                ->havingRaw('AVG((location_rate + amenities_rate + price_rate + room_rate + food_rate + tour_operator) / 6) >= ?', [$rating]);
        });
    }
}
