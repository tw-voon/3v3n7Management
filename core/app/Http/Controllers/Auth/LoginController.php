<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use Auth, Redirect, Validator;
use App\Mail\invitation;
use Carbon\Carbon;
use DB;

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

    public function roles_id(){
        return 'roles_id';
    }

    public function login(Request $request){

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')],$request->has('remember'))) {
            
            if(Auth::user()->roles_id == '1' || Auth::user()->roles_id == '4'){
                return Redirect::to('/home');
            } else {
                Auth::logout(); // log the user out of our application
                return Redirect::to('login')->withErrors('You do not have permission to enter this panel');; // redirect the user to the login screen
            }

        } else 
            return Redirect::to('login')->withErrors('Wrong Email or password');

    }

    public function logout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }

    public function test(){

        $now = Carbon::now()->addDay();
        $event_id = DB::table('events')->whereRaw('DATE(start_time) = ?', [ $now->toDateString()] )->pluck('id');
        $data = DB::table('events')->whereRaw('DATE(start_time) = ?', [ $now->toDateString()] )->get();
        $attendees = DB::table('event_attendees')->whereIn('event_id',$event_id)->distinct()->get();
        
        echo phpinfo();
        exit;

        foreach ($attendees as $key => $attendee) {

            $users = DB::table('users')->where('id',$attendee->user_id)->get();
            $events = DB::table('events')->where('id',$attendee->event_id)->get();
            $location = DB::table('event_location')->where('id',$events[0]->location_id)->get();

            echo "<pre>";
            print_r( $users );
            print_r( $events );
            echo "</pre>";

            $objDemo = new \stdClass();
            $objDemo->title = $events[0]->title;
            $objDemo->description = $events[0]->description;
            $objDemo->start_time = $events[0]->start_time;
            $objDemo->end_time = $events[0]->end_time;
            $objDemo->location = $location[0]->name;
            $objDemo->address = $location[0]->address;
            $objDemo->sender = 'Kuching IT Solution - Event Management Team';
            $objDemo->receiver = $users[0]->name;
 
            Mail::to("t.wui1993@gmail.com")->send(new invitation($objDemo));

        }

    }
}
