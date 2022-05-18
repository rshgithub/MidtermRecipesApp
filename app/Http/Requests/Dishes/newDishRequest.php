<?php

namespace App\Http\Requests\Dishes;

use Illuminate\Foundation\Http\FormRequest;

class newDishRequest extends FormRequest
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

            'name'=>'required|string|unique:dishes,name',
            'category_id'=>'required|numeric|exists:categories,id',
            'preparation_time'=>'required|string',
            'description'=>'required|max:1000',
            'serve'=>'required|string',
            'cooking_time'=>'required|string',
            'image'=>'sometimes|image|mimes:jpg,png,jpeg' // required

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'name.string' => 'Name must be string!',
            'name.unique' => 'Name must be unique!',
            'category_id.required' => 'category_id is required!',
            'category_id.numeric' => 'category_id must be numeric!',
            'category_id.exists' => 'category_id must exist in categories table!',
            'preparation_time.required' => 'preparation_time is required!',
            'preparation_time.string' => 'preparation_time must be string!',
            'description.required' => 'description is required!',
            'description.max:1000' => 'description text max:1000!',
            'serve.required' => 'serve is required!',
            'serve.string' => 'serve must be string!',
            'cooking_time.required' => 'cooking_time is required!',
            'cooking_time.string' => 'cooking_time must be string!',
            'image.mimes' => 'image directory must be jpg or png or jpeg!',
//            'image.required' => 'image is required!',
            'image.image' => 'file must be an image!'
        ];
    }
}
