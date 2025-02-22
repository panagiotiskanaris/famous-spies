<?php

namespace App\Http\Resources\Spy;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource['name'],
            'surname' => $this->resource['surname'],
            'country_of_operation' => $this->resource['country_of_operation'],
            'date_of_birth' => $this->resource['date_of_birth'],
            'date_of_death' => $this->resource['date_of_death'],
        ];
    }
}
