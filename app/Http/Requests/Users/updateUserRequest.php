<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
            'name' => 'sometimes|string|max:25'.$this->user_id,
            'email' => 'sometimes|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255|unique:users',
            'address' =>  'sometimes|string|max:255',
            'phone' =>  'sometimes|string|between:10,14',
            'avatar'=>'sometimes|mimes:jpg,png,jpeg|nullable',

        ];
    }

    public function messages()
    {
        return [
            'name.string'=>'name must be string!',
            'email.string'=>'email must be string!',
            'address.string'=>'address must be string!',
            'email.unique'=>'email must be unique!',
            'phone.numeric' => 'phone is numeric!',
            'phone.unique' => 'phone must be unique!',
            'email.email' => 'email must be valid email address!',
            'avatar.mimes:jpg,png,jpeg' => 'avatar mimes is only jpg,png,jpeg!'
        ];
    }
}
