<?php

namespace App\Interfaces\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'section'   => 'required|string|max:100',
            'title'     => 'required|string|max:255',
            'body'      => 'nullable|string',
            'image_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
            'order'     => 'integer|min:0',
        ];
    }
}