<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

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
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string|min:10|max:255',
            'image' => 'required|image|mimes:jpeg,png',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The Title is required',
            'title.string' => 'The Title must be a string',
            'title.min' => 'The Title must be at least 3 characters',
            'title.max' => 'The Title cannot be more than 255 characters',
            'body.required' => 'The body is required',
            'body.string' => 'The body must be a string',
            'body.min' => 'The body must be at least 10 characters',
            'image.mimes'=>"Image Must be jpeg or png format",
            'image.required'=>"Image is required"
        ];
    }
}
