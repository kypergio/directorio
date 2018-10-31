<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;
use App\User;
use DB;
use App\UserAvailableTimings;
use App\Rating;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //
    public function __construct()
    {
        /*$this->middleware('auth');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $userid = Auth::user()->id;
        $sql = " select (select count(*) as count from ratings where fromuserid = '$userid' ) as reviewsFromme , (select count(*) as count from ratings where touserid = '$userid' ) as reviewsTome ";
        $myReviews = DB::select($sql);
        $myReviews = $myReviews[0];
        
        return view('front.user.dashboard', compact('myReviews'));
    }

    public function editprofile(){
        $userdetails = Auth::user();
        
        $userid = $userdetails->id;
        $usertimings = UserAvailableTimings::where('userid','=',$userid)->first();
        
        if($userdetails->type == 4){
            return view('front.user.dashboardmyprofile-visitor', compact('userdetails', 'usertimings'));
        }
        return view('front.user.dashboardmyprofile', compact('userdetails', 'usertimings'));
    }

    public function updateprofile_details(Request $request){
        $validatedData = $request->validate([
            'fullname' => 'required|min:3|max:25',
            'phone' => 'required|max:15',
            'description' => 'required|min:20',
            'about' => 'required|min:20',
            'profilepic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
        $userdata = Auth::user();
        $userid = $userdata->id;
        $userSlug = $userdata->userslug;
        $userProfilePic = $userdata->image;

        $uploadedFilename = '';
        if ($request->hasFile('profilepic')) {
            // to upload file
            $file = $request->file('profilepic');
            $destinationPath = public_path(). '/uploads/userimage/'.$userid.'/';
            $filename = $file->getClientOriginalName();
            $getExtension = $file->guessExtension();

            $uploadedFilename = time().'_'.$userSlug.'.'.$getExtension;
            $file->move($destinationPath, $uploadedFilename);

            // remove if previous image available
            if($userProfilePic && file_exists($destinationPath.$userProfilePic)){
                unlink($destinationPath.$userProfilePic);
            }
        }
        //User profile details updates.
        $updateArr = [
            'name' => $request->get('fullname'),
            'phone' => $request->get('phone'),
            'description' => $request->get('description'),
            'about' => $request->get('about'),
            'specialization' => $request->get('specialization'),
            'website' => $request->get('website'),
        ];
        if($uploadedFilename){
            $updateArr['image']     = $uploadedFilename;
        }
        
        $userUpdate = User::where('id', $userid)->update($updateArr);

        //User available time updates.
        $updateTimeArr = [];
        $daysArr = array('mon' => 'Monday', 'tue'  => 'Tuesday', 'wed' => 'Wednesday', 'thu'  => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday');
        foreach ($daysArr as $key => $value) {
            $updateTimeArr[$key.'Status'] = ($request->get($key.'AvailableStatus') == 'on') ? 1 : 0;
            $updateTimeArr[$key.'Timing'] = $request->get($key.'Fromtime').'-'.$request->get($key.'Totime');
        }
        $userTimeUpdates = UserAvailableTimings::where('userid', $userid)->update($updateTimeArr);

        if($userUpdate){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Profile details have been updates successfully!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }
        
        return redirect()->route('user.editprofile');
        
    }
    // for visitor type user
    public function updateprofile_details_visitor(Request $request){
        $validatedData = $request->validate([
            'fullname' => 'required|min:3|max:25',
            'phone' => 'required|max:15',
            'description' => 'required|min:20',
            'profilepic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
        $userdata = Auth::user();
        $userid = $userdata->id;
        $userSlug = $userdata->userslug;
        $userProfilePic = $userdata->image;

        $uploadedFilename = '';
        if ($request->hasFile('profilepic')) {
            // to upload file
            $file = $request->file('profilepic');
            $destinationPath = public_path(). '/uploads/userimage/'.$userid.'/';
            $filename = $file->getClientOriginalName();
            $getExtension = $file->guessExtension();

            $uploadedFilename = time().'_'.$userSlug.'.'.$getExtension;
            $file->move($destinationPath, $uploadedFilename);

            // remove if previous image available
            if($userProfilePic && file_exists($destinationPath.$userProfilePic)){
                unlink($destinationPath.$userProfilePic);
            }
        }
        //User profile details updates.
        $updateArr = [
            'name' => $request->get('fullname'),
            'phone' => $request->get('phone'),
            'description' => $request->get('description'),
        ];
        if($uploadedFilename){
            $updateArr['image']     = $uploadedFilename;
        }
        
        $userUpdate = User::where('id', $userid)->update($updateArr);

        if($userUpdate){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Profile details have been updates successfully!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }
        
        return redirect()->route('user.editprofile');
    }

    public function userlocation(){
        $userdetails = Auth::user();
        return view('front.user.dashboardmylocation', compact('userdetails'));
    }

    public function userlocation_update(Request $request){
        $lat = $request->get('latitude');
        $lng = $request->get('longitude');
        $varylat = $lat + 0.0000540000000;
        $varylng = $lng + 0.0000540000000;
        /*echo "$lat,$lng";
        echo "<br>";
        echo "$varylat,$varylng";die();*/

        $updateArr = [
            'address' => $request->get('address'),
            'lat' => $lat,
            'lng' => $lng,
            'varylat' => $varylat,
            'varylng' => $varylng,
            'street' => $request->get('street'),
            'colony' => $request->get('colony'),
            'state' => $request->get('state'),
            'city' => $request->get('city')
        ];
        $userid = Auth::user()->id;
        $userUpdate = User::where('id', $userid)->update($updateArr);

        if($userUpdate){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Location details have been updates successfully!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }
        
        return redirect()->route('user.userlocation');

    }

    public function reviewsFromMe(){
        $userid = Auth::user()->id;

        $reviews = Rating::where("fromuserid", $userid)->with("from", "to")->get();
        return view('front.user.dashboardreviews', compact('reviews'));
    }

    public function reviewsToMe(){
        $userid = Auth::user()->id;

        $reviews = Rating::where("touserid", $userid)->with("from", "to")->get();

        return view('front.user.dashboardreviews-tome', compact('reviews'));
    }
    public function userSubmitReview(Request $request){
        $validatedData = $request->validate([
            'rateVal' => 'required|integer|between:1,5',
            'usercomments' => 'required|min:20'
        ]);
        $requestPath = $request->path();
        $explode = explode('/', $requestPath);
        
        if(count($explode) !== 2){
            redirect()->back();
            exit();
        }
        
        $getslug = $explode[1];
        $getUserDetails = User::where('userslug','=',$getslug)->first();
        if(!$getUserDetails){
            redirect()->back();
            exit();
        }
        
        $fromUser = Auth::user()->id;
        $rateVal = $request->get('rateVal');
        $comment = $request->get('usercomments');
        $toUser = $getUserDetails->id;

        $review = new Rating;
        $review->fromuserid = $fromUser;
        $review->touserid = $toUser;
        $review->rating = $rateVal;
        $review->comment = $comment;
        $detailsSave = $review->save();

        $lastInsertedId = $review->id;

        if($lastInsertedId){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Congratulations!, You have successfully added your comments!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }
        $data = ['email' => $getUserDetails->email, 'username' => ucfirst($getUserDetails->name), 'userslug' => $getslug];
        Mail::send('email.review-received', $data, function($message) use ($data){
            $message->to($data['email'], $data['username'])->subject('Revisión dejada por un usuario para ti!')
            ->from('jadw@gorool.com', 'My Directory');
        });
        
        return redirect()->back();
    }
    
    public function changepassword(){
        return view('front.user.dashboardchangepassword');
    }
    public function changepassword_save(Request $request){
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

        $user = Auth::user();
        $user->password = bcrypt($request->get('newpwd'));
        $user->save();
 
        return redirect()->back()->with("success","Password changed successfully !");
    }

}
