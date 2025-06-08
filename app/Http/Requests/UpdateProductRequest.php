<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'price' => 'required|numeric',
            'description' => 'required|string|max:200',
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
            'name.max' => 'The Name may not be greater than 30 characters.',
            'name.required' => 'The Name field is required.',
            'price.numeric' => 'The Price must be a number.',
            'price.required' => 'The Price field is required.',
            'description.max' => 'The Description may not be greater than 200 characters.',
            'description.required' => 'The Description field is required.',
        ];
    }
}
