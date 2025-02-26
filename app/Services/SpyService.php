<?php

declare(strict_types=1);

namespace App\Services;

use App\Filters\SpyFilters;
use App\Models\Spy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SpyService
{
    public function getSpies(SpyFilters $filters, int $perPage = 15): LengthAwarePaginator
    {
        return Spy::query()
            ->filter($filters)
            ->with('agency')
            ->paginate($perPage);
    }

    public function getRandomSpies(): Collection
    {
        return Spy::query()
            ->inRandomOrder()
            ->take(5)
            ->with('agency')
            ->get();
    }
}
