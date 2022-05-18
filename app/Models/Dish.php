<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nagy\LaravelRating\Traits\Rate\Rateable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Dish extends Model
{
    use HasFactory , Favoriteable , Rateable , SoftDeletes;

    protected $fillable = ['id','category_id','name','image','preparation_time','cooking_time','serve','description'];

    protected $hidden = ['created_at','updated_at','category'];

    protected $appends = ['dish_category_name','is_favorited_by_user','favs_count','ratings_count','dish_avg_rating'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id')->withDefault(['name' => 'no related category']);
    }

    public function getDishCategoryNameAttribute(){
        return $this->category ? $this->category->title : 'category not found';
    }

    public function ingredients(){
        return $this->hasMany(Ingredient::class,'dish_id','id');
    }

    public function getCategoryNameAttribute(){
        return $this->category ? $this->category->name : 'category not found';
    }

    public function getRatingsCountAttribute()
    {
        return $this->ratings()->count();
    }

    public function getDishAvgRatingAttribute()
    {
        return $this->ratingsAvg() ? $this->ratingsAvg() : 0;
    }

    public function getFavsCountAttribute()
    {
        return $this->favorites()->count();
    }

    public function getIngredientsCountAttribute()
    {
        return $this->ingredients()->count();
    }

    public function getDishIngredientsAttribute(){
        return $this->ingredients ? $this->ingredients : 'ingredients not found';
    }

    function getIsFavoritedByUserAttribute()
    {
        if (auth()->check()) {
            return auth()->user()->hasFavorited($this);
        } else {
            return false;
        }
    }


    public static function boot() {
        parent::boot();

        static::deleting(function($dish) {
            $dish->ingredients()->delete();
        });
    }
}
