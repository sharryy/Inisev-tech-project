<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title'               => 'required|string|max:255',
            'slug'                => 'required|string|max:255',
            'content'             => 'required|string',
            'websites_website_id' => 'required|integer|exists:websites,website_id'
        ];
    }
}
