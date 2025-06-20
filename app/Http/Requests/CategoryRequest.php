<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
