<?php

namespace App\Rules;

use App\Models\Spy;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueSpy implements ValidationRule
{
    public function __construct(private $surname, private $agencyId) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $agencyExists = Spy::query()
            ->where('name', $value)
            ->where('surname', $this->surname)
            ->where('agency_id', $this->agencyId)
            ->exists();

        if ($agencyExists) {
            $fail('The combination of name, surname, and agency already exists.');
        }
    }
}
