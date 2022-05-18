<?php

namespace App\Http\Requests\Ratings;

use Illuminate\Foundation\Http\FormRequest;

class updateRateRequest extends FormRequest
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

            'user_id'=>'sometimes|numeric|exists:users,user_id'.$this->rating_id,
            'dish_id'=>'sometimes|numeric|exists:dishes,dish_id',
            'rate'=>'sometimes|numeric|max:5',
        ];
    }

    public function messages()
    {
        return [

            'user_id.numeric' => 'user_id must be numeric!',
            'user_id.exists' => 'user_id must exist in users table!',
            'dish_id.numeric' => 'dish_id must be numeric!',
            'dish_id.exists' => 'user_id must exist in dishes table!',
            'rate.numeric' => 'rate must be numeric!',
            'rate.max:5' => 'rate max = 5!',

        ];
    }
}
