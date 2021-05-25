<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $user = auth()->user();
            return response()->json([
                'user' => $user,
                'access_token' => $user->createToken($user->name)->accessToken,
            ]);
        }

        return response()->json('data is invalid');
    }
}
