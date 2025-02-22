<?php

declare(strict_types=1);

namespace App\Http\Controllers\Spy;

use App\Http\Controllers\Controller;
use App\Http\Resources\Spy\SpyResource;
use App\Models\Spy;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RandomSpiesController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $randomSpies = Spy::query()->inRandomOrder()->take(5)->get();

        return SpyResource::collection($randomSpies);
    }
}
