<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;
use App\Vendor;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Redirect;
use Mail;
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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // session(['url.intended' => url()->previous()]);
        // $this->redirectTo = session()->get('url.intended');

        $this->middleware('guest')->except('logout');
    }

    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function logout(Request $request){
        $this->performLogout($request);
        return redirect('/');
    }

    public function redirectToFacebookProvider(){
        return Socialite::driver('facebook ')->redirect();
    }

    public function handleFacebookProviderCallback(Request $request){
        try {

            if (!$request->has('code') || $request->has('denied')) {
                return redirect('/');
            }

            $userSocial = Socialite::driver('facebook')->user();
            $chars = array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G');
            $password = '';
            $max = count($chars)-1;
            for($i=0;$i<8;$i++){
                $password .= (!($i % 5) && $i ? '-' : '').$chars[rand(0, $max)];
            }

            $findUser=User::where('email',$userSocial->email)->first();

            if($findUser){
                Auth::loginUsingId($findUser->id);
                return Redirect::intended($this->redirectPath('/'));
            }else{

                $user= new User();
                $user->f_name=$userSocial->name;
                $user->l_name=$userSocial->name;
                $user->email=$userSocial->email;
                $user->password=bcrypt($password);
                $user->facebook_id=$userSocial->getId();
                // $user->email_verified_at = date('Format String');
                $user->save();
                Auth::loginUsingId($user->id);
                return Redirect::intended($this->redirectPath('/'));

            }
            return redirect('/');
        } catch (Exception $e) {
            return redirect ('/');
        }
    }


    public function redirectToGoogleProvider(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback(){
        try{

            $userSocial = Socialite::driver('google')->user();
            $chars = array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G');
            $password = '';
            $max = count($chars)-1;
            for($i=0;$i<8;$i++){
                $password .= (!($i % 5) && $i ? '-' : '').$chars[rand(0, $max)];
            }

            $findUser=User::where('email',$userSocial->email)->first();

            //dd($findUser);
            if($findUser){
                //Auth::loginUsingId($findUser->id);
                Auth::login($findUser);
                return Redirect::intended($this->redirectPath('/'));
            }else{
                $user= new User();
                $user->f_name=$userSocial->user['given_name'];
                $user->l_name=$userSocial->user['family_name'];
                $user->email=$userSocial->email;
                $user->password=bcrypt($password);
                $user->google_id=$userSocial->getId();
                // $user->email_verified_at = date('Format String');
                $user->save();
                //Auth::loginUsingId($user->id);
                Auth::login($user);
            }
            return redirect('/');

        } catch (Exception $e) {
            return redirect ('/');
        }
    }


}
