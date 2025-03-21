<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'phonenumber' => [
                'required',
                'string',
                'unique:users',
                'regex:/^\+?[0-9\s()-]{7,15}$/'
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username is required.',
            'phonenumber.required' => 'Phone number is required.',
            'phonenumber.unique' => 'This phone number is already taken.',
            'phonenumber.regex' => 'Invalid phone number format.',
        ];
    }
}
