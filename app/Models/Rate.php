<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'ratings';
    protected $fillable = ['rate'];
    protected $hidden = ['created_at','updated_at','type'];
    protected $guarded = [];



    public function user(){
        return $this->belongsTo(User::class, 'user_id','id')->withDefault(['name' => 'no related user']);
    }

    public function dish(){
        return $this->belongsTo(Dish::class, 'dish_id','id')->withDefault(['name' => 'no related dish']);
    }


}
