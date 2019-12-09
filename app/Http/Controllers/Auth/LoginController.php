<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
    * 將用戶重定向至Githut頁面
    *
    * @return Response
    */
    public function redirrectProvder()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * 從Github取得用戶資訊
     *  @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $authUser = Socialite::driver('github')->user();

        } catch (Exception $e) {
            return Redirect::to('login/github');
        }
        dd($authUser);
        Auth::login($authUser, true);

        // return redirect('/home');

        $user = Socialite::driver('github')->user();

        // OAuth Two Providers
        $token = $user->token;
        $refreshToken = $user->refreshToken; // not always provided
        $expiresIn = $user->expiresIn;

        // OAuth One Providers
        $token = $user->token;
        $tokenSecret = $user->tokenSecret;

        // All Providers
        $user->getId();
        $user->getNickname();
        $user->getName();
        $user->getEmail();
        $user->getAvatar();
    }
}
