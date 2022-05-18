<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dishes\newDishRequest;
use App\Http\Requests\Dishes\updateDishRequest;
use App\Http\Requests\Ratings\newRateRequest;
use App\Http\Resources\DishResource;
use App\Models\Dish;
use App\Models\Favorite;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class DishesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json( Dish::all());
    }

    public function getDeletedDishes()
    {
        return response()->json( (Dish::onlyTrashed()->get() ));
    }

    public function getDishesWithDeleted()
    {
        return response()->json( (Dish::withTrashed()->get() ));
    }

    public function getDishesWithIngredients()
    {
        return response()->json( DishResource::collection(Dish::all()) );
    }

    public function getDishIngredients($dish)
    {
        $dishIngredients = Dish::with('ingredients')->find($dish);
        return response()->json( ['message' => 'success', 'data' => $dishIngredients ]);
    }

    public function restoreDeletedRow($dish)
    {
        $trashed = Dish::withTrashed()->find($dish);
        if($trashed) {
            $trashed->restore();
            return response()->json(['message'=>'success' , 'data' => $trashed]);
        }else{
            return response()->json(['message' => 'this Dish is not trashed']);
        }
    }

    public function getMostFavedDishes(){

        $mostFaved = Favorite::selectRaw('favoriteable_type , favoriteable_id, count(favoriteable_id) as faved_times')
            ->where('favoriteable_type', 'App\\Models\\Dish')
            ->groupBy('favoriteable_type','favoriteable_id')
            ->orderByDesc('faved_times')
            ->limit(5)
            ->get();

        return response()->json(['message' => 'success', 'data' => $mostFaved]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newDishRequest $request)
    {

        $dish = Dish::create($request->validated());
        return response()->json(['message' => 'success', 'data' => DishResource::make($dish)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show($dish){
        if($dish) {
            return response()->json(['message'=>'success' , 'data'=> DishResource::make($dish)]);
        }else{
            return response()->json(['message' => 'this Dish does not exist']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit($dish){
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(updateDishRequest $request, $dish )
    {
        if($dish) {
            $dish->update($request->validated());
            return response()->json(['message'=>'success' , 'data'=> DishResource::make($dish)]);
        }else{
            return response()->json(['message' => 'this Dish does not exist']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy($dish)
    {

        if($dish) {
            $dish->delete();
            Ingredient::where('dish_id', $dish)->delete();
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message' => 'this Dish does not exist']);
        }
    }

    public function deleteAllDishes(){
        $count = DB::table('dishes')->count();
        if($count != 0) {
            Dish::truncate();
            return response()->json(['message'=>'success']);
        }else {
            return response()->json(['message' => 'table is already empty']);
        }

    }

    // ------------------------------------------------------ favorite -------------------------------------------------

    public function addDishToFavs($dish){
        $user = Auth::user();
        $dish = Dish::find($dish);

         if($dish) {
            $user->favorite($dish);
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message' => 'this Dish does not exist']);
        }
    }

    public function unFavDish($dish){
        $user = Auth::user();
        $dish = Dish::find($dish);

        if($dish) {
            $user->unfavorite($dish);
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message' => 'this Dish does not exist']);
        }

    }

    // ------------------------------------------------------ rating ---------------------------------------------------

    public function rateDish(newRateRequest $request , $dish){
        $user = Auth::user();
        $dish = Dish::find($dish);

        if($dish) {
            $user->rate($dish, $request->rate);
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message' => 'this Dish does not exist']);
        }

    }

    public function unRateDish($dish){
        $user = Auth::user();
        $dish = Dish::find($dish);

        if($dish) {
            $user->unrate($dish);
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message' => 'this Dish does not exist']);
        }

    }


}
