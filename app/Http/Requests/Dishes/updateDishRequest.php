<?php

namespace App\Http\Requests\Dishes;

use Illuminate\Foundation\Http\FormRequest;

class updateDishRequest extends FormRequest
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

            'name'=>'sometimes|string|unique:dishes,name'.$this->dish_id,
            'category_id'=>'sometimes|numeric|exists:categories,id',
            'preparation_time'=>'sometimes|string',
            'description'=>'sometimes|max:1000',
            'serve'=>'sometimes|string',
            'cooking_time'=>'sometimes|string',
            'image'=>'sometimes|image|mimes:jpg,png,jpeg'

        ];
    }

    public function messages()
    {
        return [

            'name.string' => 'Name must be string!',
            'name.unique' => 'Name must be unique!',
            'category_id.numeric' => 'category_id must be numeric!',
            'category_id.exists' => 'category_id must exist in categories table!',
            'preparation_time.string' => 'preparation_time must be string!',
            'description.sometimes' => 'description is sometimes!',
            'description.max:1000' => 'description text max:1000!',
            'serve.string' => 'serve must be string!',
            'cooking_time.string' => 'cooking_time must be string!',
            'image.mimes' => 'image directory must be jpg or png or jpeg!',
            'image.image' => 'file must be an image!'
        ];
    }
}
