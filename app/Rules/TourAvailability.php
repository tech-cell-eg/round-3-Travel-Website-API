<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class TourAvailability implements ValidationRule
{
    private $startDate;
    private $ticketTypes;
    private $maxCapacity = 10;
    private $availableSpots;

    /**
     * Create a new rule instance.
     *
     * @param string $startDate
     * @param array $ticketTypes
     * @return void
     */
    public function __construct($startDate, $ticketTypes)
    {
        $this->startDate = $startDate;
        $this->ticketTypes = $ticketTypes;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tourId = $value;
        $totalPeopleAlreadyBooked = $this->getTotalPeopleBookedForDate($tourId, $this->startDate);
        $totalPeopleInCurrentBooking = $this->getTotalPeopleInCurrentBooking();
        
        $this->availableSpots = $this->maxCapacity - $totalPeopleAlreadyBooked;
        
        if (($totalPeopleAlreadyBooked + $totalPeopleInCurrentBooking) > $this->maxCapacity) {
            if ($this->availableSpots <= 0) {
                $fail("This tour is fully booked for {$this->startDate}. Please select another date.");
            } else {
                $fail("Only {$this->availableSpots} spots available for this tour on {$this->startDate}.");
            }
        }
    }

    /**
     * Get total number of people already booked for a specific tour on a specific date
     */
    private function getTotalPeopleBookedForDate($tourId, $date)
    {
        return DB::table('reservations')
            ->where('tour_id', $tourId)
            ->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->join('reservation_tickets', 'reservations.id', '=', 'reservation_tickets.reservation_id')
            ->sum('reservation_tickets.quantity');
    }

    /**
     * Get total number of people in the current booking request
     */
    private function getTotalPeopleInCurrentBooking()
    {
        $totalPeople = 0;
        
        if (!is_array($this->ticketTypes)) {
            return $totalPeople;
        }
        
        foreach ($this->ticketTypes as $ticket) {
            $totalPeople += isset($ticket['quantity']) ? (int) $ticket['quantity'] : 0;
        }
        
        return $totalPeople;
    }
}