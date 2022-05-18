<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['dish_id','ingredient','unit','measure'];
    protected $hidden = ['created_at','updated_at','dish'];

    protected $appends = ['ingredient_dish_name'];

    public function dish(){
        return $this->belongsTo(Dish::class, 'dish_id','id')->withDefault(['name' => 'no related dish']);
    }

    public function getIngredientDishNameAttribute(){
        return $this->dish ? $this->dish->name : 'dish not found';
    }

}
