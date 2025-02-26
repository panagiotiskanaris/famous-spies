<?php

declare(strict_types=1);

namespace App\Traits;

use App\Filters\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter($query, QueryFilters $filters): Builder
    {
        return $filters->apply($query);
    }
}
