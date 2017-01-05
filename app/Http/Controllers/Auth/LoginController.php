<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;



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
        $this->middleware('guest', ['except' => 'logout']);
    }

    
    public function loginSocial(Request $request)
    {
      $socialType = $request->get('social_type');
      \Session::put('social_type', $socialType);
      return \Socialite::driver($socialType)->redirect();
    }

    public function loginCallback(){
      $socialType = \Session::pull('social_type');
      $userSocial = \Socialite::driver($socialType)->user();

      $user = User::where('email', $userSocial->email)->first();

      if(!$user){
          $user = User::create([
            'email' => $userSocial->email,
            'password'=> bcrypt(str_random(10)),
            'name' => $userSocial->name
          ]);
      } 
      \Auth::login($user);
      return redirect()->intended($this->redirectPath());
      //dd($userSocial);
    }
}
