<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Carbon\Carbon;

class EnsureUserCanReviewTour
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $tourId = $request->route('tour'); 
        $today = Carbon::today();

        $hasReservation = Reservation::where('user_id', $user->id)
            ->where('tour_id', $tourId)
            ->orWhereDate('start_date', '<=', $today)
            ->exists();

        if (! $hasReservation) {
            abort(403, 'You are not authorized to review this tour.');
        }

        return $next($request);
    }
}
