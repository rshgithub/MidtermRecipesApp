<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ingredients\newIngredientRequest;
use App\Http\Requests\Ingredients\updateIngredientRequest;
use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json( IngredientResource::collection(Ingredient::all()) );
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(newIngredientRequest $request)
    {
        $ingredient = Ingredient::create($request->validated());
        return response()->json(['message' => 'success', 'data' => IngredientResource::make($ingredient)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($ingredient){
        if($ingredient) {
            return response()->json(['message'=>'success' , 'data'=> IngredientResource::make($ingredient)]);
        }else{
            return response()->json(['message' => 'this Ingredients does not exist']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit($ingredient){
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(updateIngredientRequest $request, $ingredient )
    {
        if($ingredient) {
            $ingredient->update($request->validated());
            return response()->json(['message'=>'success' , 'data'=> IngredientResource::make($ingredient)]);
        }else{
            return response()->json(['message' => 'this Ingredients does not exist']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($ingredient)
    {
        if($ingredient) {
            $ingredient->delete();
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message' => 'this Ingredients does not exist']);
        }
    }

    public function deleteAllIngredients(){
        $count = DB::table('ingredients')->count();
        if($count != 0) {
            Ingredient::truncate();
            return response()->json(['message'=>'success']);
        }else {
            return response()->json(['message' => 'table is already empty']);
        }

    }
}
