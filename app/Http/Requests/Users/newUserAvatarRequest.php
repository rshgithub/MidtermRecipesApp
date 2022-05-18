<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class newUserAvatarRequest extends FormRequest
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
            'avatar'=>'required|mimes:jpg,png,jpeg|nullable'
        ];
    }

    public function messages()
    {
        return [
            'avatar.required' => 'file is required!',
            'avatar.mimes' => 'file directory must be jpg or png or jpeg!',
        ];
    }
}
