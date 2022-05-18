<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['dish_id','ingredient','unit','measure'];

    public function dish(){
        return $this->belongsTo(Dish::class, 'dish_id','id')->withDefault(['name' => 'no related dish']);
    }

}
