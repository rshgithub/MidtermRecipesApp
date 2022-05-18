<?php

namespace App\Http\Controllers;

use App\Http\Requests\Favorites\newFavoriteRequest;
use App\Http\Requests\Favorites\updateFavoriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( Favorite::all() );
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
    public function store(newFavoriteRequest $request)
    {
        $Favorite = Favorite::create($request->validated());
        return response()->json(['message' => 'success', 'data' => $Favorite]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorite  $Favorite
     * @return \Illuminate\Http\Response
     */
    public function show($Favorite){
        if($Favorite) {
            return response()->json(['message'=>'success' , 'data'=> $Favorite]);
        }else{
            return response()->json(['message' => 'this Favorite does not exist']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favorite  $Favorite
     * @return \Illuminate\Http\Response
     */
    public function edit($Favorite){
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favorite  $Favorite
     * @return \Illuminate\Http\Response
     */
    public function update(updateFavoriteRequest $request, $Favorite )
    {
        if($Favorite) {
            $Favorite->update($request->validated());
            return response()->json(['message'=>'success' , 'data'=> $Favorite]);
        }else{
            return response()->json(['message' => 'this Favorite does not exist']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $Favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy($Favorite)
    {
        if($Favorite) {
            $Favorite->delete();
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message' => 'this Favorite does not exist']);
        }
    }

    public function getAllAuthFavs()
    {
        $Favorites = Auth::user()->user_favs;

        if ($Favorites) {
            return response()->json(['message' => 'success', 'data' => $Favorites->makeHidden(['user_id']) ]);
        } else {
            return response()->json(['message' => 'you do not not have any favorites yet ']);
        }

    }


    public function getAllUserFavs($user)
    {
        $user = User::find($user);
        if ($user) {
            $Favorites = $user->user_favs;
            if ($Favorites) {
                return response()->json(['message' => 'success', 'data' => $Favorites->makeHidden(['user_id']) ]);
            } else {
                return response()->json(['message' => 'user does not have any favorites yet ']);
            }
        } else {
            return response()->json(['message' => 'this user does not exist']);
        }
    }

    public function deleteAllAuthFavs()
    {
        $Favorites = Auth::user()->user_favs;
        if (!$Favorites->isEmpty()) {
            Favorite::where('user_id', auth()->user()->id)->delete();
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'you do not have any favorites yet']);
        }
    }

    public function deleteAllUserFavs($user)
    {
        $user = User::find($user);
        if ($user) {
            $Favorites = $user->user_favs;
            if (!$Favorites->isEmpty()) {
                Favorite::where('user_id', $user->id)->delete();
                return response()->json(['message' => 'success']);
            } else {
                return response()->json(['message' => 'user does not have any favorites yet ']);
            }
        } else {
            return response()->json(['message' => 'this user does not exist']);
        }
    }

}
