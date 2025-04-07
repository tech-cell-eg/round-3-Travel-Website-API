<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'slug'  => $this->slug,
            'image' => $this->image,
            'tours' => TourResource::collection($this->whenLoaded('tours')),
            'tours_count' => $this->tours_count,
            'slug'  => $this->slug,
        ];
    }
}
