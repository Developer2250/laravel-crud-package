<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'author_id' => 'required',
            'published_date' => 'required',
            'isbn' => 'required|string|max:20',
            'summary' => 'required|string',
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
            'title.max' => 'The Title may not be greater than 100 characters.',
            'title.required' => 'The Title field is required.',
            'author_id.required' => 'The Author id field is required.',
            'published_date.required' => 'The Published date field is required.',
            'isbn.max' => 'The Isbn may not be greater than 20 characters.',
            'isbn.required' => 'The Isbn field is required.',
            'summary.required' => 'The Summary field is required.',
        ];
    }
}
