<?php

namespace App\Http\Controllers\Website;

use App\Models\TourCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\TourCategoryResource;
use App\Traits\ApiResponse;

class TourCategoryController extends Controller
{
    use ApiResponse;
    
    public function index()
    {
        $tourCategories = TourCategoryResource::collection(TourCategory::latest()->take(6)->get());
        return $this->successResponse($tourCategories, 'Tour categories fetched successfully');
    }

    public function show(TourCategory $tourCategory)
    {
        $tourCategory = new TourCategoryResource($tourCategory->load('tours')->loadCount('tours'));
        return $this->successResponse($tourCategory, 'Tour category fetched successfully');
    }
}
