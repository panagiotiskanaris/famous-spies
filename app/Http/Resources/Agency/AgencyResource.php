<?php

declare(strict_types=1);

namespace App\Http\Resources\Agency;

use App\Http\Resources\Spy\SpyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource['id'],
            'name' => $this->resource['name'],
            'spies' => SpyResource::collection($this->whenLoaded('spies')),
        ];
    }
}
