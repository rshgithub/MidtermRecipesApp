<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class newCategoryRequest extends FormRequest
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

            'title'=>'required|string|unique:categories,title',
            'image'=>'required|image|mimes:jpg,png,jpeg'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'title is required!',
            'title.string' => 'title must be string!',
            'title.unique' => 'title must be unique!',
            'image.mimes' => 'image directory must be jpg or png or jpeg!',
            'image.required' => 'image is required!',
            'image.image' => 'file must be an image!'
        ];
    }
}
