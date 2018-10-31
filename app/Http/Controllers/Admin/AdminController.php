<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Hash;
use App\User;
use DB;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultData = [];

        $sql = " SELECT (select count(*) as count from users where type != 1) as usersCount, (select count(*) as count from contactformdetails ) as contactsCount  ";
        $countData = DB::select($sql);
        $countData = $countData[0];
        
        return view('admin.index', compact('countData'));
    }

    public function changepassword(){
        return view('admin.changepassword');
    }

    public function savenewpassword(Request $request){
        if (!(Hash::check($request->get('oldpwd'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('oldpwd'), $request->get('newpwd')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'oldpwd' => 'required',
            'newpwd' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('newpwd'));
        $user->save();
 
        return redirect()->back()->with("success","Los detalles se han actualizado con éxito !");
    }

    public function changeusername(){
        return view('admin.changeusername');
    }
    public function savenewusername(Request $request){
        $validatedData = $request->validate([
            'newusername' => 'required|email|unique:users,email',
        ]);

        $user = Auth::user();
        $user->email = $request->get('newusername');
        $user->save();

        return redirect()->back()->with("success","Los detalles se han actualizado con éxito !");
    }
    
}
