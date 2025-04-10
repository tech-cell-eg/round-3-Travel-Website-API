<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourTicketPricesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'ticket_type' => TourTicketTypeResource::make($this->whenLoaded('ticketType')),
            // 'ticket_type' => $this->ticketType->name,
            // 'ticket_max_age' => $this->ticketType->age_max,
            // 'ticket_min_age' => $this->ticketType->age_min,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
