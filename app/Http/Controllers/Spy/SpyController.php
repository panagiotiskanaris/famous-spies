<?php

declare(strict_types=1);

namespace App\Http\Controllers\Spy;

use App\Actions\Spies\CreateSpyAction;
use App\Actions\Spies\DeleteSpyAction;
use App\Filters\SpyFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Spy\CreateSpyRequest;
use App\Http\Requests\Spy\SpyRequest;
use App\Http\Resources\Spy\SpyResource;
use App\Models\Spy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class SpyController extends Controller
{
    public function index(SpyRequest $request, SpyFilters $filters): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $spies = Spy::query()
            ->filter($filters)
            ->with('agency')
            ->paginate($validated['perPage'] ?? 15);

        return SpyResource::collection($spies);
    }

    public function store(CreateSpyRequest $request, CreateSpyAction $action): SpyResource
    {
        $validated = $request->validated();

        $spy = $action->handle($validated);

        return SpyResource::make($spy);
    }

    public function destroy(Spy $spy, DeleteSpyAction $action): JsonResponse
    {
        abort_if(
            $spy->agency()->exists(),
            Response::HTTP_UNAUTHORIZED,
            'The requested spy is associated with agency.'
        );

        $action->handle($spy);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
