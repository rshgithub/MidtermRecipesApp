<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DishesController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('home', HomeController::class);

    Route::post('changePassword', [AuthController::class, 'changePassword']);

    // ----------------------------------------------------- users -----------------------------------------------------

    Route::delete('deleteAllUsers', [UsersController::class, 'deleteAllUsers']);
    Route::get('geUserProfile/{id}', [UsersController::class, 'geUserProfile']);

    Route::apiResource('users', UsersController::class);

    // ------------------------------------------------------ favorite -------------------------------------------------

    Route::get('getAllAuthFavs', [FavoritesController::class, 'getAllAuthFavs']);
    Route::get('getAllUserFavs/{id}', [FavoritesController::class, 'getAllUserFavs']);
    Route::delete('deleteAllAuthFavs', [FavoritesController::class, 'deleteAllAuthFavs']);
    Route::delete('deleteAllUserFavs/{id}', [FavoritesController::class, 'deleteAllUserFavs']);

    Route::apiResource('favorites', FavoritesController::class);

    // ------------------------------------------------------ rating ---------------------------------------------------

    Route::get('getAllAuthRatings', [RatingsController::class, 'getAllAuthRatings']);
    Route::get('getAllUserRatings/{id}', [RatingsController::class, 'getAllUserRatings']);
    Route::delete('deleteAllAuthRatings', [RatingsController::class, 'deleteAllAuthRatings']);
    Route::delete('deleteAllUserRatings/{id}', [RatingsController::class, 'deleteAllUserRatings']);

    Route::apiResource('ratings', RatingsController::class);

    // ------------------------------------------------------ dish -----------------------------------------------------

    Route::post('addDishToFavs/{id}', [DishesController::class, 'addDishToFavs']);
    Route::post('unFavDish/{id}', [DishesController::class, 'unFavDish']);
    Route::post('rateDish/{id}', [DishesController::class, 'rateDish']);
    Route::post('unRateDish/{id}', [DishesController::class, 'unRateDish']);

    Route::delete('deleteAllDishes', [DishesController::class, 'deleteAllDishes']);
    Route::get('getDishesWithIngredients', [DishesController::class, 'getDishesWithIngredients']);
    Route::get('getDishIngredients/{id}', [DishesController::class, 'getDishIngredients']);
    Route::get('getMostFavedDishes', [DishesController::class, 'getMostFavedDishes']);
    Route::get('getDeletedDishes', [DishesController::class, 'getDeletedDishes']);
    Route::get('getDishesWithDeleted', [DishesController::class, 'getDishesWithDeleted']);
    Route::get('restoreDeletedRow/{id}', [DishesController::class, 'restoreDeletedRow']);

    Route::apiResource('dishes', DishesController::class);

    // ---------------------------------------------------- category ---------------------------------------------------

    Route::delete('deleteAllCategories', [CategoriesController::class, 'deleteAllCategories']);
    Route::get('getCategoriesWithDishes', [CategoriesController::class, 'getCategoriesWithDishes']);
    Route::get('getCategoryDishes/{id}', [CategoriesController::class, 'getCategoryDishes']);

    Route::apiResource('categories', CategoriesController::class);

    // ---------------------------------------------------- ingredient ---------------------------------------------------

    Route::delete('deleteAllIngredients', [IngredientsController::class, 'deleteAllIngredients']);

    Route::apiResource('ingredients', IngredientsController::class);


});
