<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\DishResource;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::all()->take(5);
        $recipes = Dish::orderBy('id', 'desc')->take(5)->get();

        return response()->json([
            'message' => 'Welcome to our Recipes App',
            'data' => [
                'categories' => $categories,
                'recipes' => $recipes,
            ],
        ], 200);
    }
}
