<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Dish;
use App\Models\Favorite;
use App\Models\Ingredient;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

        Route::bind('category',function($model_id){
            $model = Category::find($model_id);
            if($model){
                return $model;
            }else{
                return false;
            }
        });
        Route::bind('dish',function($model_id){
            $model = Dish::find($model_id);
            if($model){
                return $model;
            }else{
                return false;
            }
        });
        Route::bind('user',function($model_id){
            $model = User::find($model_id);
            if($model){
                return $model;
            }else{
                return false;
            }
        });
        Route::bind('favorite',function($model_id){
            $model = Favorite::find($model_id);
            if($model){
                return $model;
            }else{
                return false;
            }
        });
        Route::bind('rate',function($model_id){
            $model = Rate::find($model_id);
            if($model){
                return $model;
            }else{
                return false;
            }
        });
        Route::bind('ingredient',function($model_id){
            $model = Ingredient::find($model_id);
            if($model){
                return $model;
            }else{
                return false;
            }
        });

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
