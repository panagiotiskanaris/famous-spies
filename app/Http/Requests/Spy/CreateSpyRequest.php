<?php

declare(strict_types=1);

namespace App\Http\Requests\Spy;

use App\Rules\UniqueSpy;
use Illuminate\Foundation\Http\FormRequest;

class CreateSpyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'surname' => ['required', 'string', 'min:2', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'date_of_death' => ['nullable', 'date'],
            'agency_id' => ['nullable', 'exists:agencies,id'],
            'country_of_operation' => ['nullable', 'string', 'min:2', 'max:255'],
            'name' => ['bail', 'required', 'string', 'min:2', 'max:255', new UniqueSpy($this->surname, $this->agency_id)],
        ];
    }
}
