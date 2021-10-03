<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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


    // Facebook login
    public function redirectToFacebook()
    {
        
        return Socialite::driver('facebook')
          
            ->redirect();
    }

    // Facebook callback
    public function handleFacebookCallback(Request $request)
    {


        $user = Socialite::driver('facebook')
           
            ->user();

        // dd($user);

           

        $this->_registerOrLoginUser($user);

        // Return home after login
        return redirect()->route('home');
    }


    protected function _registerOrLoginUser($data)
    {
        if (!empty($data->email)) {

            $user = User::where('email', '=', $data->email)->first();
            if (!$user) {
                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->provider_id = $data->id;
                $user->avatar = $data->avatar;
                $user->save();
          }

            Auth::login($user);

        } else {
            Http::delete("https://graph.facebook.com/v2.4/me/permissions?access_token={$data->token}");
            return redirect('login')->with('error', 'Email access is required.');
        }
        
    }
}
