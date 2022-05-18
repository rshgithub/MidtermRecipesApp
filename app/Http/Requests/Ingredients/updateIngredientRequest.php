<?php

namespace App\Http\Requests\Ingredients;

use Illuminate\Foundation\Http\FormRequest;

class updateIngredientRequest extends FormRequest
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

            'dish_id'=>'sometimes|numeric|exists:dishes,id'.$this->ingredient_id,
            'unit'=>'sometimes|numeric|',
            'ingredient'=>'sometimes|string',
            'measure'=>'sometimes|in:g,kg,cl,L,lbs,tsp,tbs,gill,cup'

        ];
    }

    public function messages()
    {
        return [
            'dish_id.numeric' => 'dish_id must be numeric!',
            'dish_id.exists' => 'user_id must exist in dishes table!',
            'ingredient.string' => 'ingredient must be string!',
            'unit.numeric' => 'unit must be numeric!',
            'measure.in:g,kg,cl,L,lbs,tsp,tbs,gill,cup' => 'measure must be in g,kg,cl,L,lbs,tsp,tbs,gill or cup',
        ];
    }
}
