<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Nagy\LaravelRating\Traits\Rate\CanRate;
use Overtrue\LaravelFavorite\Traits\Favoriter;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Favoriter , CanRate ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'avatar',
        'fcm_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'fcm_token',
        'verified_at',
        'verification_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'verified_at' => 'datetime',
    ];


    public function favorites(){
        return $this->hasMany(Favorite::class,'user_id','id');
    }

    public function ratings(){
        return $this->hasMany(Rate::class,'model_id','id');
    }

    public function getUserRatingsAttribute(){
        return $this->ratings ? $this->ratings : 'no ratings found';
    }

    public function getRatingsCountAttribute()
    {
        return $this->ratings()->count();
    }

    public function getUserFavsAttribute(){
        return $this->favorites ? $this->favorites : 'no favorites found';
    }

    public function getFavsCountAttribute()
    {
        return $this->favorites()->count();
    }


}
