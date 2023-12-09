<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if (auth()->user()->is_admin) {
            return '/admins';
        }

        return '/movie-list';
    }
    public function redirectToGoogle(){
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->stateless()->user();
        $this->_registerOrLoginUser($user);

        return redirect()->route('frontend.home');
    }

    public function redirectToFacebook(){
        return Socialite::driver('facebook')->stateless()->redirect();
    }
    public function handleFacebookCallback(){
        $user = Socialite::driver('facebook')->stateless()->user();

        $this->_registerOrLoginUser($user);

        return redirect()->route('frontend.home');
    }

    protected function _registerOrLoginUser($data){
        $user = User::where('email','=',$data->email)->first();
        if(!$user){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->save();
        }
        Auth::login($user);
    }
}
