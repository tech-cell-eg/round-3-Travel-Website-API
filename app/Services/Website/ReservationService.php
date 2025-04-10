<?php

namespace App\Services\Website;

use App\Models\Tour;
use App\Models\Extra;
use App\Models\Reservation;
use App\Models\TourTicketPrice;
use App\Models\ReservationExtra;
use App\Models\ReservationTicket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ReservationService
{
    /**
     * Create a new reservation with associated ticket counts and extras.
     *
     * @param array $data Validated data from the request
     * @return Reservation The created reservation
     */
    public function createReservation(array $data, Tour $tour): Reservation
    {
        return DB::transaction(function () use ($data, $tour) {
            $ticketTypes = $data['ticket_types'];
            $extras = $data['extras'] ?? [];

            // Calculate costs and total people
            $ticketCostData = $this->calculateTicketCost($tour->id, $ticketTypes);
            $extraCost = $this->calculateExtraCost($extras, $ticketCostData['totalPeople']);
            $totalPrice = $ticketCostData['ticketCost'] + $extraCost;

            // Create the reservation
            $reservation = $this->createReservationRecord($data, $totalPrice, $tour);

            // Create associated records
            $this->createTicketCounts($reservation, $ticketTypes);
            $this->createExtras($reservation, $extras, $ticketCostData['totalPeople']);

            return $reservation;
        });
    }

    /**
     * Calculate the total ticket cost and number of people.
     *
     * @param int $tourId
     * @param array $ticketTypes
     * @return array
     */
    protected function calculateTicketCost(int $tourId, array $ticketTypes): array
    {
        $ticketCost = 0;
        $totalPeople = 0;

        foreach ($ticketTypes as $ticket) {
            $ticketTypeId = $ticket['ticket_type_id'];
            $quantity = $ticket['quantity'];
            $price = TourTicketPrice::where('tour_id', $tourId)
                ->where('ticket_type_id', $ticketTypeId)
                ->firstOrFail()->price;
            $ticketCost += $price * $quantity;
            $totalPeople += $quantity;
        }

        return [
            'ticketCost' => $ticketCost,
            'totalPeople' => $totalPeople,
        ];
    }

    /**
     * Calculate the total cost of extras.
     *
     * @param array $extras
     * @param int $totalPeople
     * @return int
     */
    protected function calculateExtraCost(array $extras, int $totalPeople): int
    {
        $extraCost = 0;

        foreach ($extras as $extraId) {
            $extra = Extra::findOrFail($extraId);
            if ($extra->per_person) {
                $extraCost += $extra->price * $totalPeople;
            } else {
                $extraCost += $extra->price * 1; 
            }
        }

        return $extraCost;
    }

    /**
     * Create the reservation record.
     *
     * @param array $data
     * @param int $totalPrice
     * @param Tour $tour
     * @return Reservation
     */
    protected function createReservationRecord(array $data, int $totalPrice, Tour $tour): Reservation
    {
        return $tour->reservations()->create([
            'user_id' => Auth::id(),
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'total_price' => $totalPrice,
        ]);
    }

    /**
     * Create reservation ticket counts.
     *
     * @param Reservation $reservation
     * @param array $ticketTypes
     * @return void
     */
    protected function createTicketCounts(Reservation $reservation, array $ticketTypes): void
    {
        foreach ($ticketTypes as $ticket) {
            ReservationTicket::create([
                'reservation_id' => $reservation->id,
                'ticket_type_id' => $ticket['ticket_type_id'],
                'quantity' => $ticket['quantity'],
            ]);
        }
    }

    /**
     * Create reservation extras.
     *
     * @param Reservation $reservation
     * @param array $extras
     * @param int $totalPeople
     * @return void
     */
    protected function createExtras(Reservation $reservation, array $extras, int $totalPeople): void
    {
        foreach ($extras as $extraId) {
            $extra = Extra::findOrFail($extraId);
            $type = $extra->per_person ? 'per_person' : 'per_booking';
            $quantity = $extra->per_person ? $totalPeople : 1;
            ReservationExtra::create([
                'reservation_id' => $reservation->id,
                'extra_id' => $extraId,
                'type' => $type,
                'quantity' => $quantity,
            ]);
        }
    }
}