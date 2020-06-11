<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Models\SocialIdentity;
use Redirect;
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
    protected $redirectTo = '/';

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
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $findUser = SocialIdentity::where('user_id', $user->id)->first();
        if($findUser){
            Auth::login($findUser);
            return Redirect::to('/');
        } else {
            $ex_name = explode(" ", $user->name);
            $new_user = User::create([
                'first_name' => $ex_name[0],
                'last_name' => $ex_name[1],
                'email' => $user->email
            ]);
            $social_user = SocialIdentity::create([
                'user_id' => $new_user->id,
                'provider_name' => $user->name,
                'provider_id' => $user->id
            ]);
            
            Auth::login($new_user);
            return redirect('/');    
        
        }
        // $user->token;
        //return view ( 'site.pages.homepage' );
    }

}
