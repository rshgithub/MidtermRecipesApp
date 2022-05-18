<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'dish_id' => $this->dish_id,
            'ingredient' => $this->ingredient,
            'unit' => $this->unit,
            'measure' => $this->measure,
            'ingredient_dish_name' => $this->ingredient_dish_name,
        ];
    }
}
