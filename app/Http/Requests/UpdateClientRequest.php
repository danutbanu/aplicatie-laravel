<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',

            'cnp' => [
                'required',
                'string',
                'size:13',
                Rule::unique('clients', 'cnp')->ignore($this->client),
            ],

            'email' => [
                'required',
                'email',
                Rule::unique('clients', 'email')->ignore($this->client),
            ],

            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'identity_series' => 'required|string|max:20',
            'identity_number' => 'required|string|max:20',
            'street' => 'required|string|max:30',
            'city' => 'required|string|max:100',
            'county' => 'required|string|max:100',

            'identity_front_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'identity_back_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

            'notes' => 'nullable|string',
        ];
    }
}
