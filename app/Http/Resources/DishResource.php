<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DishResource extends JsonResource
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
            'category_id' => $this->category_id,
            'category_name' => $this->dish_category_name,
            'name' => $this->name,
            'image' => $this->image,
            'preparation_time' => $this->preparation_time,
            'cooking_time' => $this->cooking_time,
            'serve' => $this->serve,
            'description' => $this->description,
            'favs_count' => $this->favs_count,
            'is_favorited_by_user' => $this->is_favorited_by_user,
            'ratings_count' => $this->ratings_count,
            'dish_avg_rating' => $this->dish_avg_rating,
            'ingredients_count' => $this->ingredients_count,
            'dish_ingredients' => IngredientResource::collection($this->dish_ingredients),
        ];
    }
}
