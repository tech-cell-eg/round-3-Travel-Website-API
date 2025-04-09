<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Review\StoreReviewRequest;
use App\Models\Tour;
use App\Traits\ApiResponse;

class TourReviewController extends Controller
{
    use ApiResponse;

    public function store(StoreReviewRequest $request, Tour $tour)
    {
        $review = $tour->reviews()->create($request->validated());
        return $this->successResponse($review, 'Review created successfully', 201);
    }
}
