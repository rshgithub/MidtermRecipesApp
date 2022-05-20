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

    Route::delete('AllUsers', [UsersController::class, 'deleteAllUsers']);
    Route::get('UserProfile/{id}', [UsersController::class, 'getUserProfile']);

    Route::apiResource('users', UsersController::class);

    // ------------------------------------------------------ favorite -------------------------------------------------

    Route::get('AllAuthFavs', [FavoritesController::class, 'getAllAuthFavs']);
    Route::get('AllUserFavs/{id}', [FavoritesController::class, 'getAllUserFavs']);
    Route::delete('AllAuthFavs', [FavoritesController::class, 'deleteAllAuthFavs']);
    Route::delete('AllUserFavs/{id}', [FavoritesController::class, 'deleteAllUserFavs']);

    Route::apiResource('favorites', FavoritesController::class);

    // ------------------------------------------------------ rating ---------------------------------------------------

    Route::get('AllAuthRatings', [RatingsController::class, 'getAllAuthRatings']);
    Route::get('AllUserRatings/{id}', [RatingsController::class, 'getAllUserRatings']);
    Route::delete('AllAuthRatings', [RatingsController::class, 'deleteAllAuthRatings']);
    Route::delete('AllUserRatings/{id}', [RatingsController::class, 'deleteAllUserRatings']);

    Route::apiResource('ratings', RatingsController::class);

    // ------------------------------------------------------ dish -----------------------------------------------------

    Route::post('addDishToFavs/{id}', [DishesController::class, 'addDishToFavs']);
    Route::post('unFavDish/{id}', [DishesController::class, 'unFavDish']);
    Route::post('rateDish/{id}', [DishesController::class, 'rateDish']);
    Route::post('unRateDish/{id}', [DishesController::class, 'unRateDish']);

    Route::delete('AllDishes', [DishesController::class, 'deleteAllDishes']);
    Route::get('DishesWithIngredients', [DishesController::class, 'getDishesWithIngredients']);
    Route::get('DishIngredients/{id}', [DishesController::class, 'getDishIngredients']);
    Route::get('MostFavedDishes', [DishesController::class, 'getMostFavedDishes']);
    Route::get('DeletedDishes', [DishesController::class, 'getDeletedDishes']);
    Route::get('DishesWithDeleted', [DishesController::class, 'getDishesWithDeleted']);
    Route::get('DeletedDish/{id}', [DishesController::class, 'restoreDeletedDish']);

    Route::apiResource('dishes', DishesController::class);

    // ---------------------------------------------------- category ---------------------------------------------------

    Route::delete('AllCategories', [CategoriesController::class, 'deleteAllCategories']);
    Route::get('CategoriesWithDishes', [CategoriesController::class, 'getCategoriesWithDishes']);
    Route::get('CategoryDishes/{id}', [CategoriesController::class, 'getCategoryDishes']);

    Route::apiResource('categories', CategoriesController::class);

    // ---------------------------------------------------- ingredient ---------------------------------------------------

    Route::delete('
    AllIngredients', [IngredientsController::class, 'deleteAllIngredients']);

    Route::apiResource('ingredients', IngredientsController::class);


});
