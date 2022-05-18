<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class newUserRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'email' => 'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255|unique:users,email',
            'address' =>  'required|max:255',
            'phone' =>  'required|string|between:10,14|unique:users,phone',
            'avatar'=>'sometimes|mimes:jpg,png,jpeg|nullable',
            'password' => ['required', 'confirmed', Password::defaults()],

        ];
    }

    public function messages()
    {
        return [
            'name.string'=>'name must be string!',
            'name.max:25'=>'name max must be 25 characters!',
            'email.string'=>'email must be string!',
            'address.string'=>'address must be string!',
            'email.unique'=>'email must be unique!',
            'name.required' => 'name is required!',
            'phone.required' => 'phone is required!',
            'phone.string' => 'phone is string!',
            'phone.unique' => 'phone must be unique!',
            'phone.between:10,14' => 'phone must be between:10,15!',
            'email.required' => 'email is required!',
            'email.email' => 'email must be valid email address!',
            'address.required' => 'address is required!',
            'avatar.mimes:jpg,png,jpeg' => 'avatar mimes is only jpg,png,jpeg!'
        ];
    }
}
