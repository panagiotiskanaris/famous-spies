<?php

declare(strict_types=1);

namespace App\Http\Requests\Spy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SpyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'perPage' => ['nullable', 'integer', 'min:5', 'max:100'],

            'name' => ['nullable', 'string', 'min:2', 'max:255'],

            'agency' => ['nullable', 'string', 'min:2', 'max:255'],
            'countryOfOperation' => ['nullable', 'string', 'min:2', 'max:255'],
            'isActive' => ['nullable', 'boolean'],

            'age' => ['nullable', 'array', 'min:1', 'max:2'],
            'age.0' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:125'],
            'age.1' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:125'],

            'order' => ['nullable', 'array'],
            'order.*' => ['sometimes', 'nullable', 'array', 'min:1', 'max:2'],
            'order.*.0' => ['sometimes', 'nullable', Rule::in(['full_name', 'date_of_birth', 'date_of_death'])],
            'order.*.1' => ['sometimes', 'nullable', Rule::in(['asc', 'desc'])],
        ];
    }

    /**
     * @throws ValidationException
     */
    protected function prepareForValidation(): void
    {
        $allowedFilters = [
            'perPage',
            'name',
            'agency',
            'countryOfOperation',
            'isActive',
            'age',
            'age.0',
            'age.1',
            'order',
            'order.*',
            'order.*.0',
            'order.*.1',
        ];

        $unsupportedFilters = array_diff(array_keys($this->all()), $allowedFilters);

        if (! empty($unsupportedFilters)) {
            throw ValidationException::withMessages([
                'unsupported_filters' => 'The following filters are not supported: '.implode(', ', $unsupportedFilters),
            ]);
        }
    }
}
