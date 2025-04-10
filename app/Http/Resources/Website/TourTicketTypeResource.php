<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourTicketTypeResource extends JsonResource
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
            'name' => $this->name,
            'age_max' => $this->age_max,
            'age_min' => $this->age_min,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
