<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\event_images;
use App\Model\special_user;
use App\Model\events;
use App\Model\locations;
use App\Model\agency_user;
use App\Model\comments;
use App\Model\response;
use App\Model\feedback;
use App\Model\agency_officer;
use App\Model\agency;
use App\Model\assign;
use App\Model\attendees;
use App\Model\info;
use App\User;
use App\Http\Controllers\Web\eventPushNotification;
use File;

class apps_eventController extends Controller
{
    private $notify;

    public function __construct()
    {
        //defining our middleware for this controller
        $this->notify = new eventPushNotification();
        
    }

    public function index(Request $request){

        // search for location id first
        $location_id = $this->store_location(
            $request->input('event_venue'), 
            $request->input('venue_address'), 
            $request->input('venue_latitude'), 
            $request->input('venue_longitude')
        );

        $new_events = new events();
        $new_events->category_id = $request->input('event_category');
        $new_events->agency_id = $request->input('agent_id');
        $new_events->status_id = '1';
        $new_events->title = $request->input('event_title');
        $new_events->description = $request->input('event_description');
        $new_events->extra_info = $request->input('event_extra');
        $new_events->start_time = $request->input('event_start_time');
        $new_events->end_time = $request->input('event_end_time');
        $new_events->location_id = $location_id;
        $new_events->support = '0';
        $new_events->bookmarked = '0';
        $status = $new_events->save();

        $this->upload_image($new_events->id,$request->input('agent_id'));
        $this->notify_new_event($new_events->agency_id,$new_events->title,$new_events->id);
    	
        if($status)
            return "success";
        else 
            return "fail to create events";
    }

    private function notify_new_event($agency_id,$event_title,$event_id){

        $agency_user = agency_user::with('user')->where('user_id',$agency_id)->get();
        $agency = agency::find($agency_user[0]->id);
        $message = sprintf("%s had launched new event: %s", $agency->name,$event_title);
        $this->notify->send_to_all($message,$agency_id,'event_id',$event_id);

    }

    private function store_location($name, $address, $lat, $lon) {

        $existedLocation = locations::where('lon', $lon)->where('lat', $lat);
        echo substr($lon, 0, 7) . ' ' . substr($lat, 0, 7);
        
        if($existedLocation->exists()){
            
            /* if location is reported by previous user, will use back the same
               location id for further analysis in future */
               
            return $existedLocation->value('id');
            
        } else {
            
            $newLocation = new locations();
            $newLocation->name = $name;
            $newLocation->lat = $lat;
            $newLocation->lon = $lon;
            $newLocation->address = $address;
            $status = $newLocation->save();

        if($status)
            return $newLocation->id;
        else 
            return false;
        }

    }

    private function upload_image($event_id, $agent_id){

        $_subpath = 'events';

        if(isset($_FILES)){

            $dir = public_path() . "/images/".$_subpath."/event_".$event_id."/". $agent_id;

            if(!File::exists($dir)) {
                File::makeDirectory($dir, 0777, true);
                // return $dir;
            }

            foreach ($_FILES as $key => $files) {
                
                $path = $dir . '/' . $files['name'];
                move_uploaded_file($files['tmp_name'] , $path);

                $new_images = new event_images();
                $new_images->event_id = $event_id;
                $new_images->media_type = '1';
                // $new_images->link = $path;
                $new_images->link = $_subpath.'/event_'.$event_id.'/'.$agent_id.'/'.$files['name'];
                $new_images->save();

            }
        }

    }

    public function register_event(Request $request){
        
        $user_id = $request->input('user_id');
        $event_id = $request->input('event_id');

        $is_exists = attendees::where('user_id', $user_id)->where('event_id', $event_id)->count();

        if(!$is_exists){

            attendees::create([
                'user_id'   => $user_id,
                'event_id'  => $event_id
            ]);

            $events = events::find($event_id);
            $this->notify->generate_notification($events->agency_id,$user_id,'join_event',$event_id);

            return 'success';
        } else {
            return 'registered';
        }
    }

    public function get_all_events(Request $request){
        $user_id = $request->input('user_id');
        $events = events::with('locations','user','media')->where('status_id','1')->orderBy('created_at', 'desc')->paginate(5);
        $response = array();
        foreach ($events as $key => $value) {
            $response[$key] = response::where('user_id',$user_id)->where('event_id',$value['id'])->get();
        }
        return compact('events','response');
    }

    public function search_all_events(Request $request){

        $query = $request->input('query');

        $events = events::with('locations','user','media')
                    ->where('title','LIKE','%'.$query.'%')
                    ->where('status_id','1')
                    ->orderBy('created_at', 'desc')->paginate(10);

        return compact('events');
    }

    public function get_ongoing_events(Request $request){
        $agency_id = $request->input('user_id');
        $on_going_events = events::with('locations','user','media')->where('agency_id', $agency_id)->where('status_id','1')->orderBy('created_at', 'desc')->paginate(5);
        
        return compact('on_going_events');
    }

    public function get_completed_events(Request $request){
        $agency_id = $request->input('user_id');
        $completed_events = events::with('locations','user','media')->where('agency_id', $agency_id)->where('status_id', '0')->orderBy('created_at', 'desc')->paginate(5);
        return compact('completed_events');
    }

    public function get_current_events(Request $request){

        $event_id = $request->input('event_id');
        $user_id = $request->input('user_id');

        $common = events::find($event_id);
        $events_data = events::with('locations','media','category','officer', 'officer.user')->where('id', $event_id)->get();
        $events_host = agency_user::with('agency','user')->where('user_id', $common->agency_id)->get();
        $event_comments = comments::with('comment_belong_to')->where('event_id', $event_id)->orderBy('created_at', 'desc')->get();
        $event_responses = response::where('event_id', $event_id)->where('user_id', $user_id)->get();
        $user_join = attendees::where('event_id', $event_id)->where('user_id', $user_id)->count();
        $vip_event = special_user::where('event_id', $event_id)->where('status_id', '1')->count();
        $user_event = attendees::where('event_id', $event_id)->count();

        return compact('events_data', 'events_host', 'event_comments', 'event_responses', 'user_join', 'vip_event', 'user_event');

    }

    public function new_comments(Request $request){

        $user_id = $request->get('user_id');
        $event_id = $request->get('event_id');
        $message = $request->get('message');

        $event_comments = new comments();
        $event_comments->event_id = $event_id;
        $event_comments->user_id = $user_id;
        $event_comments->message = $message;
        $inserted_comment = $event_comments->save();

        $events = events::find($event_id);

        if($user_id != $events->agency_id) // generate noti only if action user != event agency user
            $this->notify->generate_notification($events->agency_id,$user_id,'event_comment',$event_id);
        
        $event_comments = comments::with('comment_belong_to')->where('id', $event_comments->id)->get();

        if($inserted_comment){
            return compact('event_comments');
        } else {
            return "fail";
        }
    }

    public function like_this_event(Request $request){

        $response = response::where('user_id', $request->input('user_id'))->where('event_id', $request->input('event_id'))->get();
        if(count($response))
            $response_row = response::find($response[0]->id);
        else
            $response_row = new response();

        $response_row->user_id = $request->input('user_id');
        $response_row->event_id = $request->input('event_id');
        $response_row->bookmark = empty($response_row->bookmark) ? '0' : $response_row->bookmark;
        $response_row->support = (empty($response_row->support) || $response_row->support == '0') ? '1' : '0';
        $status1 = $response_row->save();

        $events = events::find($request->input('event_id'));
        $events->support = $response_row->support == '0' ? $events->support - 1 : $events->support + 1;
        $status2 = $events->update();

        $status = $response_row->support;
        $total_like = $events->support;

        if($status1 && $status2){
            return compact('status','total_like');
        } else {
            return 'fail';
        }

    }

    public function bookmark_this_event(Request $request){

        $response = response::where('user_id', $request->input('user_id'))->where('event_id', $request->input('event_id'))->get();
        if(count($response))
            $response_row = response::find($response[0]->id);
        else 
            $response_row = new response();

        $response_row->user_id = $request->input('user_id');
        $response_row->event_id = $request->input('event_id');
        $response_row->support = empty($response_row->support) ? '0' : $response_row->support;
        $response_row->bookmark = (empty($response_row->bookmark) || $response_row->bookmark == '0') ? '1' : '0';
        $status1 = $response_row->save();

        $events = events::find($request->input('event_id'));
        $events->bookmarked = $response_row->bookmark == '0' ? $events->bookmarked - 1 : $events->bookmarked + 1;
        $status2 = $events->update();

        if($status1 && $status2){
            return $response_row->bookmark;
        } else {
            return 'fail';
        }

    }

    public function new_feedback(Request $request){

        $feedback = feedback::create([
            'event_id'  => $request->input('event_id'),
            'user_id'   => $request->input('user_id'),
            'message'   => $request->input('message'),
            'rating'    => $request->input('rating')
        ]);

        $events = events::find($request->input('event_id'));
        $this->notify->generate_notification($events->agency_id,$request->input('user_id'),'feedback_notify',$request->input('event_id'));

        if($feedback->id){
            return 'success';
        } else {
            return 'fail';
        }

    }

    public function get_feedback(Request $request){

        $feedback = feedback::with('user')->where('event_id', $request->input('event_id'))->paginate(10);
        return compact('feedback');

    }

    public function check_own_status(Request $request){
        
        // eveny time user landed at home page, a quick check will run through this table
        // to check whether they have assigned to join as special user for an events
        $status = special_user::where('user_id', $request->input('user_id'))->where('status_id', 0)->get();

        if($status->count()){
            return compact('status');
        } else {
            return 'empty';
        }
    }

    public function bookmarked_events(Request $request){

        $user_id = $request->input('user_id');
        $response = response::where('user_id', $user_id)->where('bookmark', '1')->pluck('event_id');
        $bookmarked_events = events::with('media', 'locations')->whereIn('id', $response)->get();

        return compact('bookmarked_events');
    }

    public function remove_bookmarked_event(Request $request){

        $user_id = $request->input('user_id');
        $event_id = $request->input('event_id');

        $response = response::where('user_id', $user_id)->where('event_id', $event_id)->first();
        $response->bookmark = 0;
        $response->update();

        return 'success';
    }

    public function assign_officer_list(Request $request){

        $user_id = $request->input('user_id');
        $event_id = $request->input('event_id');

        $officer_list = agency_officer::with('user')->where('agency_user_id', $user_id)->where('status', 1)->get();
        $officer = assign::with('user')->where('event_id',$event_id)->get();
        return compact('officer_list','officer');

    }

    public function assign_officer(Request $request){

        $officer_id = $request->input('officer_id');
        $event_id = $request->input('event_id');
        $agency_id = $request->input('user_id');
        $notify = false;

        $event = assign::where('event_id', $event_id)->get();

        if(count($event)){
            if($event[0]->officer_id == $officer_id){
                return 'success';
            } else {
                $events = assign::find($event[0]->id);

                if($events->officer_id != $officer_id){
                    $notify = true;
                }

                $events->officer_id = $officer_id;
                $events->update();

                if($notify){
                    $events = events::find($request->input('event_id'));
                    $this->notify->generate_notification($officer_id,$agency_id,'assign_event_officer',$event_id);
                }

                return 'success';
                
            }
        } else {
            assign::create([
                'event_id'      => $event_id,
                'officer_id'    => $officer_id
            ]);

            $events = events::find($request->input('event_id'));
            $this->notify->generate_notification($officer_id,$agency_id,'assign_event_officer',$event_id);

            return 'success';
        }

    }

    public function get_officer_task(Request $request){

        $user_id = $request->input('user_id');

        $assigned_task_id = assign::where('officer_id',$user_id)->pluck('event_id');
        $assigned_task = events::with('locations','user','media')->whereIn('id', $assigned_task_id)->get();

        return compact('assigned_task');
    }

    public function get_joined_events(Request $request){

        $user_id = $request->input('user_id');

        $joined_event_ids = attendees::where('user_id',$user_id)->pluck('event_id');
        $joined_events = events::with('locations','user','media')->whereIn('id', $joined_event_ids)->get();

        return compact('joined_events');

    }

    public function delete_events(Request $request){

        $event_id = $request->input('event_id');

        // delete events table
        events::where('event_id',$event_id)->delete();

        // delete media table
        media::where('event_id',$event_id)->delete();

        // delete assign table
        assign::where('event_id',$event_id)->delete();

        // delete event special table
        special_user::where('event_id',$event_id)->delete();

        return 'success';
    }

    public function get_apps_info(Request $request){

        $info = info::find(1);
        $info = html_entity_decode($info->source);
        return compact('info');

    }

    public function event_participants(Request $request){
        
        $event_id = $request->input('event_id');

        $attendees = attendees::where('event_id', $event_id)->pluck('user_id');
        $attended_user = User::whereIn('id', $attendees)->get();

        return compact('attended_user');

    }

}
