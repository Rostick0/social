<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
   
    public function register()
    {   
        $credentials = request(['phone', 'password','name']);

        $user = User::firstWhere('phone',$credentials['phone']);

        if ($user){
            return response()->json(['message'=>'Пользователь с такими номером телефона уже существует'],400);
        }

        $user = User::create([
            "password" => bcrypt($credentials["password"]),
            "name" =>$credentials['name'],
            "phone" =>$credentials['phone']
        ]);

        return response()->json($user);
    }

    public function login()
    {
        $credentials = request(['phone', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
  
    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 10000
        ]);
    }
}
