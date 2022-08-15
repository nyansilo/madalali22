<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email'         => 'email|required|unique:users,email,' . $this->route("user"),
            'password'      => 'required_with:password_confirmation|confirmed',
            //'role'        => 'required',
            'slug'          => 'required|unique:users,slug,' . $this->route("user"),
        ];
    }
    //'email'    => 'email|required|unique:users,email,' . $this->route("users"),
}
