<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\events;
use App\Model\event_images;
use App\Model\assign;
use App\Model\agency_user;
use App\Model\special_user;
use App\Model\comments;
use App\Model\response;
use App\Model\attendees;
use App\Model\feedback;
use Auth;

class EventsController extends Controller
{
	public function __construct()
    {
        //defining our middleware for this controller
        $this->middleware('auth');
        
    }

    public function index(){

        if(Auth::user()->roles_id == 1)
    	   $events = events::with('locations', 'user', 'category')->paginate(10);
       else
           $events = events::with('locations', 'user', 'category')->where('agency_id',Auth::user()->id)->paginate(10);
    	return view('events.index', compact('events'));

    }

    public function view(Request $request, $id){

    	$common = events::find($id);
        $events_data = events::with('locations','media','category','officer', 'officer.user')->where('id', $id)->get();
        $events_host = agency_user::with('agency','user')->where('user_id', $common->agency_id)->get();
        $event_comments = comments::with('comment_belong_to')->where('event_id', $id)->orderBy('created_at', 'desc')->get();
        $event_responses = response::where('event_id', $id)->where('user_id', $id)->get();
        $user_join = attendees::with('user')->where('event_id', $id)->get();
        $feedbacks = feedback::with('user')->where('event_id', $id)->get();
        $special_user = special_user::with('user')->where('event_id', $id)->get();

        return view('events.view', compact('common','events_data', 'events_host', 'event_comments', 'event_responses', 'user_join', 'feedbacks', 'special_user'));

    }

    public function remove(Request $request){

        $event_id = $request->input('event_id');

        // delete events table
        events::where('id',$event_id)->delete();

        // delete media table
        event_images::where('event_id',$event_id)->delete();

        // delete assign table
        assign::where('event_id',$event_id)->delete();

        // delete event special table
        special_user::where('event_id',$event_id)->delete();

        return 'success';

    }

    public function transport(Request $request){

        $user_id = $request->input('user_id');
        $event_id = $request->input('event_id');
        $transport = $request->input('required_transport');

        $attendees = attendees::where('user_id', $user_id)->where('event_id', $event_id)
                    ->update(['required_transport' => $transport]);

        return json_encode($attendees);
    }

    public function print_view(Request $request, $id){

        $event = events::find($id);
        $user_join = attendees::with('user')->where('event_id', $id)->get();

        return view('events.print', compact('event','user_join'));
    }
}
