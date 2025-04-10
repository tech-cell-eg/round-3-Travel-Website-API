<?php

namespace App\Http\Controllers\Website;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class NewsletterController extends Controller
{
    use ApiResponse;
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletters',
        ]);

        Newsletter::create($validated);

        return $this->successResponse('Email subscribed successfully');
    }
}
