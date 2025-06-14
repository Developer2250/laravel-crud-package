<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:150',
            'password' => 'required|string|max:255',
            'gender' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.max' => 'The Name may not be greater than 100 characters.',
            'name.required' => 'The Name field is required.',
            'email.max' => 'The Email may not be greater than 150 characters.',
            'email.required' => 'The Email field is required.',
            'password.max' => 'The Password may not be greater than 255 characters.',
            'password.required' => 'The Password field is required.',
            'gender.required' => 'The Gender field is required.',
        ];
    }
}
