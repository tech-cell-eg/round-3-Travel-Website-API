<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'title'              => $this->title,
            'image'              => $this->image,
            'slug'               => $this->slug,
            'group_size'         => $this->group_size,
            'ages'               => $this->ages,
            'languages'          => $this->languages,
            'description'        => $this->description,
            'duration'           => $this->duration,
            'highlights'         => $this->highlights,
            'bestseller'         => $this->bestseller,
            'free_cancellation'  => $this->free_cancellation,
            'map'                => $this->map,
            'initial_price'      => $this->initial_price,
            'rating'             => $this->averageRating(),
            'categories_rating'  => $this->categoriesRating(),
            'reviews_count'      => $this->reviews_count,
            'category'           => new TourCategoryResource($this->whenLoaded('category')),
            'destination'        => new DestinationResource($this->whenLoaded('destination')),
            'images'             => TourImageResource::collection($this->whenLoaded('images')),
            'reviews'            => ReviewResource::collection($this->whenLoaded('reviews')),
            'included_amenities' => AmenityResource::collection($this->whenLoaded('included_amenities')),
            'excluded_amenities' => AmenityResource::collection($this->whenLoaded('excluded_amenities')),
            'itineraries'        => TourItineraryResource::collection($this->whenLoaded('itineraries')),
            'ticket_prices'      => TourTicketPricesResource::collection($this->whenLoaded('ticketPrices')),
            'extras'             => ExtraResource::collection($this->whenLoaded('extras')),
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
        ];
    }
}
