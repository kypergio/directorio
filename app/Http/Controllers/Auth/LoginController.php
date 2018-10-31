<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use Illuminate\Http\Request;
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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = route("admin.home");
    }
	
	public function logout(){
		        
    	$user = Auth::user();
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

    // if user status =0 or isdelete=1(user deleted) then redirect back
    protected function sendLoginResponse(Request $request)
    {
        if($this->guard()->user()->isdelete == 1){
            $this->guard()->logout();
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors(['delete' => 'User profile have been deleted by admin. Please contact admin!']);
        }
        if($this->guard()->user()->status == 0){
            $this->guard()->logout();
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors(['status' => 'User profile have been inactivated by admin. Please contact admin!']);
        }

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }


}
