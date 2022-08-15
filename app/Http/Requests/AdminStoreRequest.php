<?php


//Command:  php artisan make:request AdminStoreRequest

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'user_name'     => 'required',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'email|required|unique:admins',
            'password'      => 'required|confirmed',
            //'role'        => 'required',
            'slug'          => 'required|unique:admins',
        ];
    }
}
