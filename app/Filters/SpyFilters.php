<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SpyFilters extends QueryFilters
{
    public function isActive(?bool $isActive = null): Builder
    {
        if ($isActive) {
            return $this->builder->whereNull('date_of_death');
        }

        return $this->builder->whereNotNull('date_of_death');
    }

    public function countryOfOperation(?string $countryOfOperation = null): Builder
    {
        if (is_null($countryOfOperation)) {
            return $this->builder;
        }

        return $this->builder->where('country_of_operation', 'like', '%'.$countryOfOperation.'%');
    }

    public function agency(?string $agency = null): Builder
    {
        if (is_null($agency)) {
            return $this->builder;
        }

        return $this->builder->whereHas('agency', function ($q) use ($agency) {
            $q->where('name', 'like', '%'.$agency.'%');
        });
    }

    public function name(?string $name = null): Builder
    {
        if (is_null($name)) {
            return $this->builder;
        }

        return $this->builder->where('name', 'like', '%'.$name.'%')
            ->orWhere('surname', 'like', '%'.$name.'%');
    }

    public function age(?array $age = null): Builder
    {
        if (is_null($age)) {
            return $this->builder;
        }

        $today = now();

        if (count($age) === 2) {
            [$minAge, $maxAge] = $age;

            $minDate = $today->copy()->subYears($maxAge + 1)->addDay();
            $maxDate = $today->copy()->subYears($minAge);

            return $this->builder->whereBetween('date_of_birth', [$minDate, $maxDate]);
        }

        if (count($age) === 1) {
            $exactAge = $age[0];

            $startDate = $today->copy()->subYears($exactAge + 1)->addDay();
            $endDate = $today->copy()->subYears($exactAge);

            return $this->builder->whereBetween('date_of_birth', [$startDate, $endDate]);
        }

        return $this->builder;
    }

    public function order(?array $orders = null): Builder
    {
        if (is_null($orders)) {
            return $this->builder->orderBy('id');
        }

        foreach ($orders as $order) {
            $field = $order[0] ?? 'id';
            $direction = $order[1] ?? 'asc';

            $column = match ($field) {
                'full_name' => "CONCAT(name, ' ', surname)",
                'date_of_birth' => 'date_of_birth',
                'date_of_death' => 'date_of_death',
                default => 'id',
            };

            $this->builder->orderByRaw("CASE WHEN $column IS NULL THEN 1 ELSE 0 END, {$column} $direction");
        }

        return $this->builder;
    }
}
