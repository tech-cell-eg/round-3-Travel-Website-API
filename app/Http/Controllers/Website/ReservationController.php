<?php

namespace App\Http\Controllers\Website;

use App\Models\Tour;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Website\ReservationService;
use App\Http\Requests\Website\Reservation\StoreReservationRequest;

class ReservationController extends Controller
{
    use ApiResponse;
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function store(StoreReservationRequest $request, Tour $tour)
    {
        $data = $request->validated();
        $this->reservationService->createReservation($data, $tour);

        return $this->successResponse(null, 'Reservation created successfully', 201);
    }
}
