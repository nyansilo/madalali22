<?php

//Command:  php artisan make:request PropertyRequest

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
        $rules = [
            //'title'           => 'required',
            'slug'            => 'required|unique:properties',
            //'address'         => 'required',
            //'region_id'       => 'required',
            //'district_id'     => 'required',
            //'category_id'     => 'required',
            //'subcategory_id'  => 'required',
            //'type'            => 'required',
            //'status'          => 'required',
            //'area'            => 'required',
            //'price'           => 'required',
            //'description'     => 'required',
            //'room'            => 'required',
            //'bed'             => 'required',
            //'bath'            => 'required',
            //'sitting_room'    => 'required',
            //'brand'           => 'required',
            //'coverage'        => 'required',
            //'engine_capacity' => 'required',
            //'color'           => 'required',
            //'driving_type'    => 'required',
            //'fuel_type'       => 'required',
            //'image'           => 'image|mimes:jpg,jpeg,bmp,png',
        ];

        //'published_at' => 'date_format:Y-m-d H:i:s',

         switch($this->method()) {
            case 'PUT':
            case 'PATCH':
                $rules['slug'] = 'required|unique:properties,slug,' . $this->route('admin.property');
                break;
        }

        return $rules;
    }
}
