<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if( Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
             $authToken = Auth::user()->createToken('auth-token')->plainTextToken;
             return response()->json(['access_token' => $authToken]);
            //return UserResource::make(Auth::user());
        } else {
            throw new InvalidCredentialsException('Invalid password');
        }
    }

    /** Logout User
     *
     */
    public function logout()
    {
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        auth('sanctum')->user()->tokens()->delete();
    }
}
