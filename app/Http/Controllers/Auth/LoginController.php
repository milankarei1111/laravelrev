<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\OAuthProvider;
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
     * 將用戶重定向至第三方登入頁面
     *
     * @return Response
     */
    public function redirrectProvder($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * 使用者授權後從第三方回傳授權資料取得用戶資訊
     *  @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $authUser = $this->findOrCreateUser($user, $provider);
            Auth::login($authUser);
            return redirect($this->redirectTo);
        } catch (Exception $e) {
            return redirect('login');
        }
    }
    /**
     * 如果用戶在使用社交身份驗證之前已經註冊，請返回該用戶
     * 否則，創建一個新的用戶對象
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    protected function findOrCreateUser($user, $provider)
    {
        $oauthProvider = OAuthProvider::where('provider', $provider)
            ->where('provider_id', $user->getId())
            ->first();

        if ($oauthProvider) {
            $oauthProvider->update([
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
            ]);

            return $oauthProvider->user;
        } else {
            return $this->createUser($provider, $user);
        }
    }

    protected function createUser($provider, $user)
    {

        $newUser = User::where('email', $user->getEmail())->first();

        if (! $newUser) {
            $newUser = User::create([
                'email' => $user->getEmail(),
                'password' => '',
            ]);
        }

        $newUser->oauthProviders()->create([
            'provider' => $provider,
            'provider_id' => $user->getId(),
            'token' => $user->token,
            'refresh_token' => $user->refreshToken,
        ]);

        return $newUser;
    }
}
