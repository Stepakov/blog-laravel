<?php

namespace App\Http\Requests\Post;

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
            'title' => [ 'required', 'string', 'min:2', 'max:255' ],
            'content' => [ 'required', 'string', 'min:2' ],
            'thumbnail' => [ 'nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048' ],
            'poster' => [ 'nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048' ],
            'category_id' => [ 'nullable', 'integer', 'exists:categories,id' ],
            'is_published' => [ 'nullable', 'string' ]
        ];
    }
}
