<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VerifyRegistration;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

use Session;

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
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $this->validate($request,[
          'email'=>'required|string',
           'password'=>'required|string',
        ]);
        $user=User::where('email',$request->email)->first();
       

            if (Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)) {
                return redirect()->intended(route('index')); 
            }
        
        
        // if (!is_null($user)) {
        //        $user->notify(new VerifyRegistration($user));
        //        session()->flash('success' , 'A New confirmation mail has sent to you...Please check and confirm your mail');
        //        return redirect('/');
        // }
            
                session()->flash('error' , 'Please Login first ');
                return redirect()->route('login');
        

    }
    public function loginuser(Request $request){
        $this->validate($request,[
          'email'=>'required|string',
           'password'=>'required|string',
        ]);
        $user=User::where('email',$request->email)->first();
       

            if (Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)) {
                return Response()->json(["Message"=>"Successfully","statusCode"=>"200"]);
            }
            else{
                return Response()->json(["Message"=>"Failed","statusCode"=>"201"]);
            }

    }

}
