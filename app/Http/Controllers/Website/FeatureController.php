<?php

namespace App\Http\Controllers\Website;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\FeatureResource;
use App\Models\Feature;

class FeatureController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return FeatureResource::collection(Feature::latest()->take(4)->get());
    }
}
