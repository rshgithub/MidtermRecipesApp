<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    public $table = "favorites";
//    protected $fillable = ['user_id','dish_id'];

    protected $hidden = ['created_at','updated_at'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id')->withDefault(['name' => 'no related user']);
    }

    public function dish(){
        return $this->belongsTo(Dish::class, 'dish_id','id')->withDefault(['name' => 'no related dish']);
    }


}
