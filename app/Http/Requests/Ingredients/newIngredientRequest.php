<?php

namespace App\Http\Requests\Ingredients;

use Illuminate\Foundation\Http\FormRequest;

class newIngredientRequest extends FormRequest
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

            'dish_id'=>'required|numeric|exists:dishes,id',
            'unit'=>'required|numeric|',
            'ingredient'=>'required|string',
            'measure'=>'required|in:g,kg,cl,L,lbs,tsp,tbs,gill,cup'

        ];
    }

    public function messages()
    {
        return [
            'dish_id.required' => 'dish_id is required!',
            'dish_id.numeric' => 'dish_id must be numeric!',
            'dish_id.exists' => 'user_id must exist in dishes table!',
            'ingredient.required' => 'ingredient is required!',
            'ingredient.string' => 'ingredient must be string!',
            'unit.required' => 'unit is required!',
            'unit.numeric' => 'unit must be numeric!',
            'measure.required' => 'measure is required!',
            'measure.in:g,kg,cl,L,lbs,tsp,tbs,gill,cup' => 'measure must be in g,kg,cl,L,lbs,tsp,tbs,gill or cup',

        ];
    }
}
