<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        // 預設guard:web, 故在此須加入指定api
        if(! $token = auth('api')->attempt($credentials)){
            return response()->json([
                'message' => 'invalid credentials'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function userData()
    {
        return response()->json([
            'value' => auth()->user()
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'value' => $token,
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
