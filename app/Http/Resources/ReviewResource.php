<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'destination_id'=> $this->destination_id,
            'user_name'     => $this->user_name,
            'rating'        => $this->rating,
            'review_text'   => $this->review_text,
            'review_date'   => $this->review_date,
            'travel_type'   => $this->travel_type,
            'year'          => $this->year,
            'helpful_count' => $this->helpful_count,
            'destination'   => new DestinationResource($this->whenLoaded('destination')),
        ];
    }
}