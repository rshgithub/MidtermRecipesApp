<?php

namespace App\Http\Requests\Favorites;

use Illuminate\Foundation\Http\FormRequest;

class newFavoriteRequest extends FormRequest
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

            'user_id'=>'required|numeric|exists:users,user_id',
            'dish_id'=>'required|numeric|exists:dishes,dish_id',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'user_id is required!',
            'user_id.numeric' => 'user_id must be numeric!',
            'user_id.exists' => 'user_id must exist in users table!',
            'dish_id.required' => 'dish_id is required!',
            'dish_id.numeric' => 'dish_id must be numeric!',
            'dish_id.exists' => 'user_id must exist in dishes table!',

        ];
    }
}
