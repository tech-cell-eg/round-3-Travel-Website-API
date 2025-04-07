<?php

namespace App\Http\Controllers\Website;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\DestinationResource;
use App\Traits\ApiResponse;

class DestinationController extends Controller
{
    use ApiResponse;
    
    public function index()
    {
        $destinations = DestinationResource::collection(Destination::withCount('tours')->latest()->paginate(8));
        return $this->successResponse($destinations, 'Destinations fetched successfully');
    }

    public function show(Destination $destination)
    {
        $destination = new DestinationResource($destination->loadCount('tours')->load('tours'));
        return $this->successResponse($destination, 'Destination fetched successfully');
    }
}
