<?php

declare(strict_types=1);

namespace App\Http\Controllers\Spies;

use App\Actions\Spies\CreateSpyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSpyRequest;
use App\Http\Resources\Spies\SpyResource;

class SpyController extends Controller
{
    public function store(CreateSpyRequest $request, CreateSpyAction $action): SpyResource
    {
        $validated = $request->validated();

        $spy = $action->handle($validated);

        return SpyResource::make($spy);
    }
}
