<?php

namespace App\Http\Controllers\Website;

use Carbon\Carbon;
use App\Models\Tour;
use App\Traits\ApiResponse;
use App\Filters\Website\TourFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\TourResource;

class TourController extends Controller
{
    use ApiResponse;

    public function index(TourFilter $filters)
    {
        $tours = Tour::with('destination')->withCount('reviews')
            ->filter($filters)
            ->latest()
            ->paginate(5);

        return $this->successResponse(TourResource::collection($tours), 'Tours fetched successfully');
    }

    public function show(Tour $tour)
    {
        $tour = new TourResource($tour->loadCount('reviews')->load('destination', 'category', 'images', 'reviews.images', 'reviews.user', 'included_amenities', 'excluded_amenities', 'itineraries', 'ticketPrices', 'extras'));
        return $this->successResponse($tour, 'Tour fetched successfully');
    }
}
