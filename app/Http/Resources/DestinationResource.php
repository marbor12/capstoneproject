<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'slug'            => $this->slug,
            'category'        => $this->category,
            'description'     => $this->description,
            'location'        => $this->location,
            'price'           => $this->price,
            'price_range'     => $this->price_range,
            'image'           => $this->image,
            'facilities'      => $this->facilities,
            'open_hours'      => $this->open_hours,
            'best_time'       => $this->best_time,
            'travel_type'     => $this->travel_type,
            'best_months'     => $this->best_months,
            'duration'        => $this->duration,
            'activity_level'  => $this->activity_level,
            'is_recommended'  => $this->is_recommended,
            'average_rating'  => $this->average_rating,
            'review_count'    => $this->review_count,
            'reviews'         => ReviewResource::collection($this->whenLoaded('reviews')),
        ];
    }
}