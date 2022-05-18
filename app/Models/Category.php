<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory ;

    protected $fillable = ['id','title','image'];
    protected $hidden = ['created_at','updated_at'];

    public function dishes(){
        return $this->hasMany(Dish::class,'category_id','id');
    }

    public function getDishesCountAttribute()
    {
        return $this->dishes()->count();
    }
    public function getCategoryDishesAttribute(){
        return $this->dishes ? $this->dishes : 'dishes not found';
    }

}
