<?php

namespace App\Http\Controllers\Website;

use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\TestimonialResource;
use App\Traits\ApiResponse;

class TestimonialController extends Controller
{   
    use ApiResponse;
    
    public function index()
    {
        $testimonials = TestimonialResource::collection(Testimonial::with('user')->latest()->paginate(5));
        return $this->successResponse($testimonials, 'Testimonials fetched successfully');
    }
}
