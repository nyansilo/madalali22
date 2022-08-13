<?php

//Command:  php artisan make:request PropertyCategoryStoreRequest

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyCategoryStoreRequest extends FormRequest
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
            'title' => 'required|unique:property_categories|max:255',
            'slug'  => 'required|unique:property_categories|max:255',
        ];
    }
}
