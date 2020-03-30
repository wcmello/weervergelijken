<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Location;
use App\Http\Resources\Location as LocationResource;

class Data extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'temp' => $this->temp,
            'rainChance' => $this->rainChance,
            'dateTime' => $this->dateTime,
            'location' => $this->location_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

