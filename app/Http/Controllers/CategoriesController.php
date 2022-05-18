<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\newCategoryRequest;
use App\Http\Requests\Categories\updateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\DishResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(['message' => 'success', 'data' => Category::all()]);
//        return response()->json(['message' => 'success', 'data' => Category::all()->take(5)]);

    }

    public function getCategoriesWithDishes()
    {
        return response()->json( CategoryResource::collection(Category::all()) );
    }

    public function getCategoryDishes($category){

        $categoryDishes = Category::with('dishes')->find($category);
        return response()->json( ['message' => 'success', 'data' => $categoryDishes ]);
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
    public function store(newCategoryRequest $request)
    {

        $category = Category::create($request->validated());
        return response()->json(['message' => 'success', 'data' => CategoryResource::make($category)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category){
        if($category) {
            return response()->json(['message'=>'success' , 'data'=> CategoryResource::make($category)]);
        }else{
            return response()->json(['message' => 'this Category does not exist']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category){
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(updateCategoryRequest $request, $category )
    {
        if($category) {
            $category->update($request->validated());
            return response()->json(['message'=>'success' , 'data'=> CategoryResource::make($category)]);
        }else{
            return response()->json(['message' => 'this Category does not exist']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        if($category) {
            $category->delete();
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message' => 'this Category does not exist']);
        }
    }

    public function deleteAllCategories(){
        $count = DB::table('categories')->count();
        if($count != 0) {
            Category::truncate();
            return response()->json(['message'=>'success']);
        }else {
            return response()->json(['message' => 'table is already empty']);
        }

    }
}
