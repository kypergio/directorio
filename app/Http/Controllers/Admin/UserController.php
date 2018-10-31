<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\UserAvailableTimings;
use DB;
use Response;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where("type","<>", 1)->where("isdelete", 0)->get();
        return view('admin.user.list', compact("users"));
    }

    public function changestatus(REQUEST $request){
        $id = $request->get('id');
        $newstatus = $request->get('newstatus');

        $update = User::where('id', $id)->update(['status' => $newstatus]);
        return $update;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(AdminPollRequest $request)
    public function store(Request $request)
    {
        $input = request()->validate([
            'userType' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|max:30|min:2',
            'contact' => 'required|max:25|min:10',
            'description' => 'required|min:20',
            'specialization' => 'required|min:20',
            'about' => 'required|min:20',
            'profilepic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'address' => 'required|min:3',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $lat = $request->get('latitude');
        $lng = $request->get('longitude');
        $varylat = $lat + 0.0000540000000;
        $varylng = $lng + 0.0000540000000;

        $userslug = $this->getEventSlug($request->get('name'));

        $user = new User;
        $user->type =  $request->get('userType');
        $user->email =  $request->input('email');
        $user->remember_token = $request->_token;
        $user->password =  bcrypt($request->get('password'));

        $user->name = $request->input('name');
        $user->userslug = $userslug;
        $user->phone =  $request->input('contact');
        if($request->input('website')){
            $user->website =  $request->input('website');
        }
        $user->description =  $request->input('description');
        $user->specialization =  $request->input('specialization');
        $user->about =  $request->input('about');


        $user->address =  $request->input('address');
        $user->street =  ($request->input('street')) ? $request->input('street'):'';
        $user->colony =  ($request->input('colony')) ? $request->input('colony') : '';
        $user->state =  ($request->input('state')) ? $request->input('state') : '';
        $user->city =  ($request->input('city')) ? $request->input('city') : '';
        $user->lat =  $request->input('latitude');
        $user->lng =  $request->input('longitude');
        $user->varylat =  $varylat;
        $user->varylng =  $varylng;
        
        $userSaved = $user->save();
        $userid = $user->id;

        //User available time updates.
        $userAvailTime = new UserAvailableTimings;
        $userAvailTime->userid = $userid;

        $daysArr = array('mon' => 'Monday', 'tue'  => 'Tuesday', 'wed' => 'Wednesday', 'thu'  => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday');
        foreach ($daysArr as $key => $value) {
            $userAvailTime->{$key.'Status'} = ($request->get($key.'AvailableStatus') == 'on') ? 1 : 0;
            $userAvailTime->{$key.'Timing'} = $request->get($key.'Fromtime').'-'.$request->get($key.'Totime');
        }
        $userAvailTime->save();

        // profile image set.
        $uploadedFilename = '';
        if ($request->hasFile('profilepic')) {
            // to upload file
            $file = $request->file('profilepic');
            $destinationPath = public_path(). '/uploads/userimage/'.$userid.'/';
            $filename = $file->getClientOriginalName();
            $getExtension = $file->guessExtension();

            $uploadedFilename = time().'_'.$userslug.'.'.$getExtension;
            $file->move($destinationPath, $uploadedFilename);
            // update user image details.
            $updateArr = ['image' => $uploadedFilename];
            $userImgUpdate = User::where('id', $userid)->update($updateArr);
        }

        

        if($userSaved){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'User details have been added successfully!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }
        
        return redirect()->route('user.index');
    }

    private function getEventSlug( $tipTitle ) {
        $slug = Str::slug( $tipTitle );
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show details';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userData = User::where('id', $id)-> first();
        $usertimings = UserAvailableTimings::where('userid','=',$userData->id)->first();
        return view('admin.user.edit', ['userData' => $userData, 'usertimings' => $usertimings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $input = request()->validate([
            'userType' => 'required',
            //'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|max:30|min:2',
            'contact' => 'required|max:25|min:10',
            'description' => 'required|min:20',
            'specialization' => 'required|min:20',
            'about' => 'required|min:20',
            'profilepic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'address' => 'required|min:3',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $lat = $request->get('latitude');
        $lng = $request->get('longitude');
        $varylat = $lat + 0.0000540000000;
        $varylng = $lng + 0.0000540000000;

        $updateArr = [
            'type' =>  $request->get('userType'),
            'password' =>  bcrypt($request->get('password')),

            'name' => $request->input('name'),
            'phone' =>  $request->input('contact'),
            
            'description' =>  $request->input('description'),
            'specialization' =>  $request->input('specialization'),
            'about' =>  $request->input('about'),

            'address' =>  $request->input('address'),
            'street' =>  ($request->input('street')) ? $request->input('street'):'',
            'colony' =>  ($request->input('colony')) ? $request->input('colony') : '',
            'state' =>  ($request->input('state')) ? $request->input('state') : '',
            'city' =>  ($request->input('city')) ? $request->input('city') : '',
            'lat' =>  $request->input('latitude'),
            'lng' =>  $request->input('longitude'),
            'varylat' =>  $varylat,
            'varylng' =>  $varylng,
        ];
        if($request->input('website')){
            $updateArr['website'] =  $request->input('website');
        }

        $uploadedFilename = '';
        if ($request->hasFile('profilepic')) {
            $getUserDetails = User::where('id', $id)->first();
            $userSlug = $getUserDetails->userslug;
            // to upload file
            $file = $request->file('profilepic');
            $destinationPath = public_path(). '/uploads/userimage/'.$id.'/';
            $filename = $file->getClientOriginalName();
            $getExtension = $file->guessExtension();

            $uploadedFilename = time().'_'.$userSlug.'.'.$getExtension;
            $file->move($destinationPath, $uploadedFilename);

            // remove if previous image available
            $userProfilePic = $getUserDetails->image;

            if($userProfilePic && file_exists($destinationPath.$userProfilePic)){
                unlink($destinationPath.$userProfilePic);
            }
            if($uploadedFilename != ''){
                $updateArr['image'] =  $uploadedFilename;
            }
        }
        
        $userUpdate = User::where('id', $id)->update($updateArr);

        //User available time updates.
        $updateTimeArr = [];
        $daysArr = array('mon' => 'Monday', 'tue'  => 'Tuesday', 'wed' => 'Wednesday', 'thu'  => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday');
        foreach ($daysArr as $key => $value) {
            $updateTimeArr[$key.'Status'] = ($request->get($key.'AvailableStatus') == 'on') ? 1 : 0;
            $updateTimeArr[$key.'Timing'] = $request->get($key.'Fromtime').'-'.$request->get($key.'Totime');
        }
        $userTimeUpdates = UserAvailableTimings::where('userid', $id)->update($updateTimeArr);

        if($userUpdate){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'User details have been updated successfully!');
        }else{ 
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }
        
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userUpdate = User::where('id', $id)->update(['isdelete' => 1]);
        return response()->json("", 200);
    }

    public function downloadUsers(){ 
        
        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=usuarios.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        //$list = User::all()->toArray();
        $list = User::where('type','!=', 1)->get(['name as Name', 'address as Address', 'lat as Latitude', 'lng as Longitude','phone as Contact', 'image as Image', 'description as Description', 'status as Status(1=active;0=inactive)'])->toArray();
        //echo "<pre>"; print_r($list); die;
        
        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));
        
        $callback = function() use ($list) {
            //print_r($list[]);die();
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                /*if($row['image'] == ''){
                    $row['image'] = 'No image found';
                }*/
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);
    }
}
