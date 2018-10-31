<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contactformdetails;
use Auth;
use App\User;
use App\UserAvailableTimings;
use DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return 'test index';//view('home');
    }

    public function mailtest(){
        //echo Mail::to('mohitdeveloepr@gmail.com')->send('test mail new KryptoniteFound');
        $data = []; // Empty array

        return view('email.registration-welcome');

        Mail::send('email.registration-welcome', $data, function($message)
        {
            $message->to('mohitdeveloepr@gmail.com', 'MyDirectory')->subject('Welcome to the platform!')
            ->from('info@webtechnocrats.com', 'My Directory');
        });
       
        return 'test testmail';//view('home');
    }
    
}
