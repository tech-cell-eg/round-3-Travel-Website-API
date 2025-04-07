<?php

namespace App\Http\Controllers\Website;

use App\Models\Tour;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\TourResource;
use App\Traits\ApiResponse;

class TourController extends Controller
{
    use ApiResponse;
    
    public function index()
    {
        $tours = TourResource::collection(Tour::with('destination', 'category')->latest()->paginate(5));
        return $this->successResponse($tours, 'Tours fetched successfully');
    }

    public function show(Tour $tour)
    {
        $tour = new TourResource($tour->load('destination', 'category'));
        return $this->successResponse($tour, 'Tour fetched successfully');
    }
}
