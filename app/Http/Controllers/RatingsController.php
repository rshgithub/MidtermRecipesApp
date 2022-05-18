<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ratings\newRateRequest;
use App\Http\Requests\Ratings\updateRateRequest;
use App\Http\Resources\RateResource;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json( Rate::all());
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
    public function store(newRateRequest $request)
    {

        $rate = Rate::create($request->validated());
        return response()->json(['message' => 'success', 'data' => $rate]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($rate){
        if($rate) {
            return response()->json(['message'=>'success' , 'data'=> $rate]);
        }else{
            return response()->json(['message' => 'this Rate does not exist']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit($rate){
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(updateRateRequest $request, $rate )
    {
        if($rate) {
            $rate->update($request->validated());
            return response()->json(['message'=>'success' , 'data'=> $rate]);
        }else{
            return response()->json(['message' => 'this Rate does not exist']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($rate)
    {
        if($rate) {
            $rate->delete();
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message' => 'this Rate does not exist']);
        }
    }

    public function getAllAuthRatings()
    {
        $ratings = Auth::user()->user_ratings;

        if ($ratings) {
            return response()->json(['message' => 'success', 'data' => $ratings->makeHidden(['created_at','updated_at','type','model_type','model_id']) ]);
        } else {
            return response()->json(['message' => 'you do not not have any ratings yet ']);
        }

    }


    public function getAllUserRatings($user)
    {
        $user = User::find($user);
        if ($user) {
            $ratings = $user->user_ratings;
            if ($ratings) {
                return response()->json(['message' => 'success', 'data' => $ratings->makeHidden(['created_at','updated_at','type','model_type','model_id']) ]);
            } else {
                return response()->json(['message' => 'user does not have any ratings yet ']);
            }
        } else {
            return response()->json(['message' => 'this user does not exist']);
        }
    }

    public function deleteAllAuthRatings(){
        $ratings = Auth::user()->user_ratings;
        if (!$ratings->isEmpty()) {
            Rate::where('model_type','App\\Models\\User')->where('type','rate')->where('model_id', auth()->user()->id)->delete();
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'you do not have any ratings yet']);
        }
    }

    public function deleteAllUserRatings($user)
    {
        $user = User::find($user);
        if ($user) {
            $ratings = $user->user_ratings;
            if (!$ratings->isEmpty()) {
                Rate::where('model_type','App\\Models\\User')->where('type','rate')->where('model_id', auth()->user()->id)->delete();
                return response()->json(['message' => 'success']);
            } else {
                return response()->json(['message' => 'user does not have any ratings yet ']);
            }
        } else {
            return response()->json(['message' => 'this user does not exist']);
        }
    }
}
