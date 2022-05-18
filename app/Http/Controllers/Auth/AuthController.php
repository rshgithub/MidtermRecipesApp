<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Users\newUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use function response;

class AuthController extends Controller
{


    public function register(newUserRequest $request)
    {

        $validated = $request->validated();

        User::creating(function ($user) {
            $user->password = Hash::make($user->password);
//            $user->verification_code = rand(100000, 999999);
        });

        $user = User::create($validated);

        $token = $user->createToken('authtoken');

//        return response()->json(['message' => 'User Registered successfully', 'data' => ['user' => $user, 'token' => $token->plainTextToken, 'verification_code' => $user->verification_code]]);
        return response()->json(['message' => 'User Registered successfully', 'data' => ['user' => $user, 'token' => $token->plainTextToken]]);
    }


    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {

//            if(!$user->verified_at){return response()->json(['message' => 'user not verified',],404);}

            $user->makeVisible('password');
            if (Hash::check($request->password, $user->password)) { // true}else{//false}
                $token = $user->createToken('authtoken');

                return response()->json(
                    [
                        'message' => 'Logged in successfully',
                        'data' => [
                            'user' => $user,
                            'token' => $token->plainTextToken
                        ]
                    ]
                );
            } else {
                return response()->json(
                    [
                        'message' => 'password is not correct',
                        'errors' => [
                            'password' => ["These credentials do not match our records",
                            ]
                        ],
                    ],404
                );
            }
        } else {
            return response()->json(
                [
                    'message' => 'email is not correct',
                    'errors' => [
                        'email' =>[
                            "These credentials do not match our records"
                        ] ,
                    ]
                ],401
            );
        }

    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->json(
            [
                'message' => 'Logged out'
            ]
        );

    }


    public function changePassword(Request $request)
    {
        $validated = $request->validate(
            [
                'current_password' => 'required',
                'password' => 'required|string|min:8',
            ]
        );

        if(!Hash::check($validated['current_password'],auth()->user()->password)){
            return response()->json(['message' => 'current password is not correct',],404);
        }

        auth()->user()->update(['password' => Hash::make($request->password)]);

    }


}
