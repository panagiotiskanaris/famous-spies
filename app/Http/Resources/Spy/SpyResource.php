<?php

namespace App\Http\Resources\Spy;

use App\Http\Resources\Agency\AgencyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'full_name' => $this->resource['full_name'],
            'country_of_operation' => $this->resource['country_of_operation'],
            'date_of_birth' => $this->resource['date_of_birth'],
            'date_of_death' => $this->resource['date_of_death'],
            'operational_period' => $this->resource['operational_period'],
            'agency' => AgencyResource::make($this->whenLoaded('agency')),
        ];
    }
}
