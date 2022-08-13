<?php

//Command:  php artisan make:request BlogCategoryStoreRequest

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:blog_categories|max:255',
            'slug'  => 'required|unique:blog_categories|max:255',
        ];
    }
}
