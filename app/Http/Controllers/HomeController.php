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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function aboutus()
    {
        return view('front.aboutus');
    }

    public function contactus()
    {
        return view('front.contactus');
    }

    public function savecontactus_details(Request $request)
    {
        $input = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comments' => 'required|min:20'
        ]);
        $contactDetails = new Contactformdetails;
        $contactDetails->fullname = $request->get('name');
        $contactDetails->email = $request->get('email');
        $contactDetails->comments = $request->get('comments');
        $detailsSave = $contactDetails->save();

        $lastInsertedId = $contactDetails->id;
        if ($lastInsertedId) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '¡Tus comentarios han sido enviados correctamente! Gracias por contactarnos.');
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '¡Ocurrio un error!');
        }

        return redirect()->route('contactus');
    }

    public function registeruser_details(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|min:3|max:25',
            'email' => 'required|unique:users|max:50',
            'password' => 'required|min:6|max:25|confirmed',
            'userSignupAs' => 'required|numeric',
        ]);

        $fullname = $request->get('fullname');
        $email = $request->get('email');
        $password = bcrypt($request->get('password'));
        $usertype = $request->get('userSignupAs');
        //if($usertype == 1){ //if somebody channge to 1 for admin from form
        $usertype = 4;//always as visitor, only admin create others: doctor, clinics
        //}
        $getuniqueurl = $this->getEventSlug($request->get('fullname'));

        $user = new User;
        $user->name = $request->get('fullname');
        $user->email = $request->get('email');
        $user->userslug = $getuniqueurl;
        $user->password = $password;
        $user->type = $usertype;
        $userSave = $user->save();
        $lastInsertedId = $user->id;

        if ($lastInsertedId) {
            $userAvailTimings = new UserAvailableTimings;
            $userAvailTimings->userid = $lastInsertedId;
            $userAvailTimings->save();

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Registration details have been added successfully! Please login');
            $redirect = 'login';
            /***********/
            /*Mail::send('email.registration-welcome', $data, function($message){
                $message->to($email, ucfirst($fullname))->subject('Welcome to the platform!');
            });*/
            $data = ['email' => $email, 'username' => ucfirst($fullname)];
            Mail::send('email.registration-welcome', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['username'])->subject('Bienvenido a Ultherapy!')
                    ->from('contacto@ultherapy.com', 'Ultherapy');
            });
            /***********/

        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
            $redirect = 'register';
        }
        return redirect()->route($redirect);
    }

    private function getEventSlug($tipTitle)
    {
        $slug = Str::slug($tipTitle);
        $slugs = User::whereRaw("userslug REGEXP '^{$slug}(-[0-9]*)?$'");

        if ($slugs->count() === 0) {
            return $slug;
        }

        // Get the last matching slug
        $lastSlug = $slugs->orderBy('userslug', 'desc')->first()->userslug;

        // Strip the number off of the last slug, if any
        $lastSlugNumber = intval(str_replace($slug . '-', '', $lastSlug));

        // Increment/append the counter and return the slug we generated
        return $slug . '-' . ($lastSlugNumber + 1);
    }

    public function userprofiledetails($userslug)
    {
        $userdetails = User::where('userslug', '=', $userslug)->first();

        $usertimings = '';
        $ratingDetails = '';
        if ($userdetails) {
            if ($userdetails->type == 4 && (!(Auth::user()) || Auth::user()->id != 1)) {
                return redirect()->to('/');
                exit();
            }
            $userid = $userdetails->id;
            $usertimings = UserAvailableTimings::where('userid', '=', $userid)->first();

            $userdetails->categorytype = ($userdetails->type == 4) ? 'Visitor' : (($userdetails->type == 2) ? 'Doctor' : 'Clinic');


            $sql = "SELECT ratings.*, users.name,users.userslug ,users.image from ratings 
                left join users on users.id=ratings.fromuserid
                where ratings.touserid='$userid'
                order by ratings.id desc ";
            $ratingDetails = DB::select($sql);
        }
        return view('front.userprofiledetails3', compact('userdetails', 'usertimings', 'ratingDetails'));
    }

    public function searchdetails_map(Request $request)
    {
        $keyword = $request->input('keyword');
        $lat = $request->input('addresslat');
        $lng = $request->input('addresslng');
        $category = $request->input('category');

        $where = '';
        // Si algo se busco general
        if($keyword != ""){
            $where .= " ( name like '%$keyword%' or address like '%$keyword%' or description like '%$keyword%' or specialization like '%$keyword%' or phone like '%$keyword%' ) ";
        }
        if($category != "") {
            // Si ya una condición anterior se le agrega AND si no, no
            $where .= ($where != "") ? ' and ' : '';
            $where .= " ( type = '$category' ) ";
        }else{
            // Si no se seleccionó la categoría entonces se busca los usuarios de tipo 2 y 3 (doctores y clínicas)
            $where .= ($where) ? ' and ' : '';
            $where .= " ( type in (2,3) ) ";
        }
        // Si se buscó por latitud y longitud
        if($lat != "" && $lng != ""){
            $range = 100;
            // Find Max - Min Lat / Long for Radius and zero point and query
            $lat_range = $range/69.172;
            $lon_range = abs($range/(cos($lat) * 69.172));
            $min_lat = number_format($lat - $lat_range, "4", ".", "");
            $max_lat = number_format($lat + $lat_range, "4", ".", "");
            $min_lon = number_format($lng - $lon_range, "4", ".", "");
            $max_lon = number_format($lng + $lon_range, "4", ".", "");

            // Se agrega AND si existe alguna otra condición antes
            $where .= ($where != "") ? ' and ' : '';
            $where .= " ( varylat BETWEEN ".$min_lat." AND ".$max_lat." AND  varylng BETWEEN ".$min_lon." AND ".$max_lon. " ) ";
        }
        $where = "$where and status = 1 and isdelete = 0 and lat !='' and lng != '' ";

        $users = User::whereRaw($where)->with("avgRating")->get();
        return response()->json($users);
    }

    public function sendProfileRequest(Request $request)
    {
        $getName = $request->get('getName');
        $getPhone = $request->get('getPhone');
        $getEmail = $request->get('getEmail');
        $getOption = $request->get('getOption');
        $getDesc = $request->get('getDesc');
        $touserid = $request->get('touserid');
        $chkUserEmail = User::where('email', $getEmail)->get()->first();
        if ($chkUserEmail) {
            echo "emailexists";
            die();
        }

        $tmpOption = ['1' => 'Solicitar costos', '2' => 'Agendar cita', '3' => '¿Soy candidata (o) al tratamiento?', '4' => 'Información sobre Ultherapy'];
        $getOption = $tmpOption[$getOption];

        $getUserDetails = User::where('id', $touserid)->get()->first();

        /************************************/
        $getuniqueurl = $this->getEventSlug($getName);

        $user = new User;
        $user->name = $getName;
        $user->email = $getEmail;
        $user->userslug = $getuniqueurl;
        $user->type = 4;//visitor
        $user->phone = $getPhone;
        $user->visitoroption = $getOption;
        $user->visitordescription = $getDesc;
        $userSave = $user->save();
        $lastInsertedId = $user->id;

        /************************************/

        $data = [
            'getName' => $getName,
            'getPhone' => $getPhone,
            'getEmail' => $getEmail,
            'getOption' => $getOption,
            'getDesc' => $getDesc,
            'email' => $getUserDetails->email,
            'username' => ucfirst($getUserDetails->name)
        ];

        /*Todo: verificar que funcionen los correos*/
        Mail::send('email.requestDetails', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['username'])->subject('Recibir consulta del usuario!');
        });

        //request confirmation mail to user
        $profilelink = url('profile') . '/' . $getUserDetails->userslug;
        $data2 = [
            'profilelink' => $profilelink,
            'email' => $getEmail,
            'username' => ucfirst($getName)
        ];
        Mail::send('email.requestDetailsConfirmToUser', $data2, function ($message) use ($data2) {
            $message->to($data2['email'], $data2['username'])->subject('Su estado de solicitud');
        });

        echo 1;
        exit();
    }

    public function forgetpassword()
    {
        if (Auth::user()) {
            return redirect()->to('/');
            exit();
        }
        return view('auth.passwords.email');
    }

    public function forgetpasswordSendLink(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            return redirect()->back()->with("error", "¡La dirección de correo electrónico que proporcionó no existe!");
        }

        $token = app('auth.password.broker')->createToken($user);

        $resetlink = url('password/reset') . '/' . $token;

        $data = [
            'resetlink' => $resetlink,
            'email' => $user->email,
            'username' => ucfirst($user->name)
        ];
        Mail::send('email.forgetpasslink', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['username'])->subject('Restablecer la contraseña');
        });

        return redirect()->back()->with("success", "Por favor revise su bandeja de entrada, restablezca el enlace de contraseña enviado a su dirección de correo electrónico.");
    }
}
