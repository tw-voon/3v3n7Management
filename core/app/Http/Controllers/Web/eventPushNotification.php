<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\notification;
use App\Model\agency_user;
use App\Model\events;
use App\Model\agency;
use App\User;

class eventPushNotification extends Controller
{
    public function send_to_all($message,$own_id,$key,$value) {

	    $content      = array(
	        "en" => $message
	    );

	    $fields = array(
	        'app_id' => "48a7a48c-dd66-456b-977d-7c7d81f4aac0",
	        'filters' => array(
	        	array("field" => "tag", "key" => "user_id", "relation" => "!=", "value" => $own_id)
	        ),
	        'data' => array(
	            $key => $value
	        ),
	        'contents' => $content
	    );
    
	    $fields = json_encode($fields);
	    print("\nJSON sent:\n");
	    print($fields);

	    $this->send_push($fields);
	   
	}

	public function send_to_specific($message, $specific_user_id, $data){

		$content      = array(
	        "en" => $message
	    );

	    $fields = array(
	        'app_id' => "48a7a48c-dd66-456b-977d-7c7d81f4aac0",
	        'filters' => array(
	        	array("field" => "tag", "key" => "user_id", "relation" => "=", "value" => $specific_user_id)
	        ),
	        'data' => $data,
	        'contents' => $content
	    );
    
	    $fields = json_encode($fields);
	    $this->send_push($fields);

	}

	public function generate_notification($specific_user_id, $action_user, $action_type, $event_id){

		switch ($action_type) {

			case 'join_event':
				$act_user = $this->get_user($action_user);
				$event = $this->get_events($event_id);
				$content = sprintf("%s had joined your event named : %s", $act_user->name,$event->title);
				$data = array(
					'action_type'	=>	'join_event',
					'event_id'		=>	$event_id
				);
				$this->store_notification($specific_user_id, $action_user, $action_type, $event_id, $content);
				$this->send_to_specific($content,$specific_user_id,$data);
				break;

			case 'assign_agency_user':
				$content = "System admin have changed your roles to Agency";
				$data = array(
					'action_type'	=>	'assign_agency_user'
				);
				$this->store_notification($specific_user_id, $action_user, $action_type, $event_id, $content);
				$this->send_to_specific($content,$specific_user_id,$data);
				break;

			case 'assign_event_officer':
				$act_user = $this->get_user($action_user);
				$event = $this->get_events($event_id);
				$content = sprintf("%s had assigned you to event : %s", $act_user->name,$event->title);
				$data = array(
					'action_type'	=>	'assign_event_officer',
					'event_id'		=>	$event_id
				);
				$this->store_notification($specific_user_id, $action_user, $action_type, $event_id, $content);
				$this->send_to_specific($content,$specific_user_id,$data);
				break;

			case 'invite_existing_officer':
				$act_user = $this->get_user($action_user);
				$agency = $this->get_agency($action_user);
				$content = sprintf("%s from agency - %s had invited you as Officer for his agency.", $act_user->name,$agency->name);
				$data = array(
					'action_type'	=>	'invite_existing_officer'
				);
				$this->store_notification($specific_user_id, $action_user, $action_type, $event_id, $content);
				$this->send_to_specific($content,$specific_user_id,$data);
				break;

			case 'invite_existing_vip':
				$act_user = $this->get_user($action_user);
				$agency = $this->get_agency($action_user);
				$event = $this->get_events($event_id);
				$content = sprintf("%s from agency - %s had invited you as VIP for the event of %s.", $act_user->name,$agency->name,$event->title);
				$data = array(
					'action_type'	=>	'invite_existing_vip',
					'event_id'		=>	$event_id
				);
				$this->store_notification($specific_user_id, $action_user, $action_type, $event_id, $content);
				$this->send_to_specific($content,$specific_user_id,$data);
				break;

			case 'feedback_notify':
				$act_user = $this->get_user($action_user);
				$event = $this->get_events($event_id);
				$content = sprintf("%s had send you a feedback for the event of : %s", $act_user->name,$event->title);
				$data = array(
					'action_type'	=>	'feedback_notify',
					'event_id'		=>	$event_id
				);
				$this->store_notification($specific_user_id, $action_user, $action_type, $event_id, $content);
				$this->send_to_specific($content,$specific_user_id,$data);
				break;

			case 'event_comment':
				$act_user = $this->get_user($action_user);
				$event = $this->get_events($event_id);
				$content = sprintf("%s had commented for the event of : %s", $act_user->name,$event->title);
				$data = array(
					'action_type'	=>	'event_comment',
					'event_id'		=>	$event_id
				);
				$this->store_notification($specific_user_id, $action_user, $action_type, $event_id, $content);
				$this->send_to_specific($content,$specific_user_id,$data);
				break;

			case 'new_event':
				$act_agency = $this->get_agency($action_user);
				$event = $this->get_events($event_id);
				$content = sprintf("%s had launched new event: %s", $act_agency->name,$event->title);
				$this->send_to_all($content,$action_user,'event_id',$event_id);
				break;
		}

	}

	private function get_events($event_id){
		$event = events::find($event_id);
		return $event;
	}

	private function get_user($user_id){
		$user = User::find($user_id);
		return $user;
	}

	private function get_agency($user_id){
		$agency_user = agency_user::where('user_id',$user_id)->get();
		$agency = agency::find($agency_user[0]->agency_id);
		return $agency;
	}

	public function store_notification($specific_user_id,$action_user,$action_type,$event_id,$content){

		$is_noti = notification::where('specific_user_id',$specific_user_id)
								->where('action_user',$action_user)
								->where('action_type',$action_type)
								->where('event_id',$event_id)->get();

		if(!count($is_noti)){
			notification::create([
				'specific_user_id' 	=> 	$specific_user_id,
				'action_user'		=>	$action_user,
				'action_type'		=> 	$action_type,
				'event_id'			=>	$event_id,
				'content'			=>	$content
			]);
		} else {
			notification::find($is_noti[0]->id)->touch();
		}
		

	}

	private function send_push($fields){

		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Content-Type: application/json; charset=utf-8',
	        'Authorization: Basic NzFjNGE1YWMtMGEwYS00NTJkLThkMGYtOTRmMTNkZDYwZjc3'
	    ));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, FALSE);
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    
	    $response = curl_exec($ch);
	    curl_close($ch);

	    return $response;
	}
}
