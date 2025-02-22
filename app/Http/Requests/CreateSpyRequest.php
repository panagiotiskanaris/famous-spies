<?php

namespace App\Http\Requests;

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
            'name' => ['bail', 'required', 'string', 'min:2', 'max:255', new UniqueSpy($this->surname, $this->agency_id)],
        ];
    }
}
