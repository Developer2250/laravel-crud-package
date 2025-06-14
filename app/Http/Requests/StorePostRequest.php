<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'user_id' => 'required',
            'title' => 'required|string|max:150',
            'content' => 'required|string',
            'comments_count' => 'required',
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
            'user_id.required' => 'The User id field is required.',
            'title.max' => 'The Title may not be greater than 150 characters.',
            'title.required' => 'The Title field is required.',
            'content.required' => 'The Content field is required.',
            'comments_count.required' => 'The Comments count field is required.',
        ];
    }
}
