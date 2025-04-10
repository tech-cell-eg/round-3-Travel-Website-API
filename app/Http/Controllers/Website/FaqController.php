<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\FaqResource;
use App\Models\Faq;
use App\Traits\ApiResponse;

class FaqController extends Controller
{
    use ApiResponse;
    
    public function index()
    {
        $faqs = FaqResource::collection(Faq::latest()->take(5)->get());
        return $this->successResponse($faqs, 'FAQs fetched successfully');
    }
}
