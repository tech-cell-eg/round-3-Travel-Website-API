<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'slug'              => $this->slug,
            'group_size'        => $this->group_size,
            'ages'              => $this->ages,
            'languages'         => $this->languages,
            'description'       => $this->description,
            'highlights'        => $this->highlights,
            'bestseller'        => $this->bestseller,
            'free_cancellation' => $this->free_cancellation,
            'map'               => $this->map,
            'category'          => new TourCategoryResource($this->whenLoaded('category')),
            'destination'       => new DestinationResource($this->whenLoaded('destination')),
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
