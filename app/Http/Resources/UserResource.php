<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'avatar' => $this->avatar,
            'ratings_count' => $this->ratings_count,
            'user_ratings' =>  $this->user_ratings,
            'favs_count' => $this->favs_count,
            'user_favs' => $this->user_favs,
        ];
    }
}
