<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\newUserRequest;
use App\Http\Requests\Users\updateUserRequest;
use App\Http\Resources\DishResource;
use App\Http\Resources\UserResource;
use App\Models\Dish;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( User::all());
    }

    public function geUserProfile($user)
    {
        $user = User::find($user);
        if($user) {
            return response()->json(['message'=>'success' , 'data'=> UserResource::make($user)]);
        }else{
            return response()->json(['message' => 'this User does not exist']);
        }
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
    public function store(newUserRequest $request)
    {

        $user = User::create($request->validated());
        return response()->json(['message' => 'success', 'data' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user){
        if($user) {
            return response()->json(['message'=>'success' , 'data'=> $user]);
        }else{
            return response()->json(['message' => 'this User does not exist']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user){
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(updateUserRequest $request, $user )
    {
        if($user) {
            $user->update($request->validated());
            return response()->json(['message'=>'success' , 'data'=> $user]);
        }else{
            return response()->json(['message' => 'this User does not exist']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        if($user) {
            $user->delete();
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message' => 'this User does not exist']);
        }
    }

    public function deleteAllUsers(){
        $count = DB::table('users')->count();
        if($count != 0) {
            User::truncate();
            return response()->json(['message'=>'success']);
        }else {
            return response()->json(['message' => 'table is already empty']);
        }

    }

}
