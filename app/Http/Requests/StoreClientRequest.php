<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'cnp' => 'required|string|size:13|unique:clients,cnp',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'identity_series' => 'required|string|max:20',
            'identity_number' => 'required|string|max:20',
            'street' => 'required|string|max:30',
            'city' => 'required|string|max:100',
            'county' => 'required|string|max:100',
            'identity_front_photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'identity_back_photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'cnp.required' => 'CNP is required.',
            'cnp.size' => 'CNP must have exactly 13 characters.',
            'cnp.unique' => 'This CNP already exists.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address already exists.',
            'phone.required' => 'Phone number is required.',
            'birth_date.required' => 'Birth date is required.',
            'identity_series.required' => 'ID series is required.',
            'identity_number.required' => 'ID number is required.',
            'street.required' => 'Street is required.',
            'city.required' => 'City is required.',
            'county.required' => 'County is required.',
            'identity_front_photo.required' => 'ID front photo is required.',
            'identity_front_photo.image' => 'ID front photo must be an image.',
            'identity_front_photo.mimes' => 'ID front photo must be a JPG or PNG file.',
            'identity_front_photo.max' => 'ID front photo must not be larger than 5 MB.',
            'identity_back_photo.required' => 'ID back photo is required.',
            'identity_back_photo.image' => 'ID back photo must be an image.',
            'identity_back_photo.mimes' => 'ID back photo must be a JPG or PNG file.',
            'identity_back_photo.max' => 'ID back photo must not be larger than 5 MB.',
            'notes.string' => 'Notes must be text.',
        ];
    }
}
