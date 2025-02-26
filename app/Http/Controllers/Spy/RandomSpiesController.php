<?php

declare(strict_types=1);

namespace App\Http\Controllers\Spy;

use App\Http\Controllers\Controller;
use App\Http\Resources\Spy\SpyResource;
use App\Services\SpyService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RandomSpiesController extends Controller
{
    public function __invoke(SpyService $service): AnonymousResourceCollection
    {
        $randomSpies = $service->getRandomSpies();

        return SpyResource::collection($randomSpies);
    }
}
