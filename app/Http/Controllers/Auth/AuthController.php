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
        $token = auth('api')->attempt($credentials); // 預設guard:web, 故在此須加入指定api
        if(! $token){
            return response()->json([
                'status' => 'E00002','message' => 'invalid credentials', 'value' => ''
            ], 401);
        }
        return response()->json([
            'status' => '000000', 'message' => 'sucess', 'value' =>$token
        ]);
    }

    public function userData()
    {
        return response()->json([
            'status' => '000000', 'message' => 'sucess', 'value' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->logout(); // 等於 Auth::user()
        return response()->json([
            'status' => '000000', 'message' => 'sucess', 'value' => ''
        ]);
    }
}
