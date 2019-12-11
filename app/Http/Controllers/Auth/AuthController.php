<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 *  @group jwtAuth
 *  使用者認證的操作
 */
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    /**
     * @bodyParam email String required 信箱 Example: abc@abc.com
     * @bodyParam password String required 密碼 Example: 12345678
     */
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

    /**
     * @authenticated
     * @response {
     *    "value": {
     *        "id": 14,
     *        "email": "user@abc.com",
     *        "permissions": null,
     *        "last_login": "2019-12-06 13:50:14",
     *        "first_name": "公司員工",
     *        "last_name": null,
     *        "created_at": "2019-12-03 02:24:48",
     *        "updated_at": "2019-12-06 13:50:14"
     *    }
     * }
     */
    public function userData()
    {
        return response()->json([
            'value' => auth()->user()
        ]);
    }
    /**
     * @queryParam token required 憑證. No-example
     */
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

    public function params(Requests\AuthRequest $request)
    {

    }
}
