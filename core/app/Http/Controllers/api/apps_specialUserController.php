<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Web\eventPushNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\events;
use App\Model\user_to_roles;
use App\Model\special_user;
use App\Model\agency_officer;
use App\Model\agency_user;
use App\Model\notification;
use App\User;
use Auth;

class apps_specialUserController extends Controller
{

    private $notify;

    public function __construct()
    {
        //defining our middleware for this controller
        $this->notify = new eventPushNotification();
        
    }

    public function search_user(Request $request){
    	// search whether this user exists
    	return User::where('email', $request->input('email'))->get();
    }

    public function get_invited_vip(Request $request){

        $event_vip = special_user::with('user')->where('event_id', $request->input('event_id'))->get();
        return compact('event_vip');

    }

    public function select_user(Request $request){

    	// when selecting special user, validate its status and their roles first
    	// roles: Top Admin - Agency not suitable
    	if($request->input('roles_id') == '2'){ // officer

    		$user = agency_officer::where('user_id', $request->input('selected_user_id'))->where('status', '!=', '-1')->get();
    		$is_vip = special_user::where('user_id', $request->input('selected_user_id'))->where('status_id', '1')->get();
    		$is_admin_agency = User::where('id', $request->input('selected_user_id'))->where('roles_id','1')->get();


    		if($is_vip->count()){ // if VIP status found associate with user, return VIP status
    			return 'vip';
    		} else if($user->count()){ // if this user already been added previously, then can't be add anymore

	    		return 'officer';
    			
    		} else if($is_admin_agency->count()){

    			return 'top_user';

    		} else {

    			agency_officer::create([
    				'agency_user_id' 	=> $request->input('user_id'),
    				'user_id'			=> $request->input('selected_user_id'),
    				'status'			=> 0
    			]);

                $this->notify->generate_notification($request->input('selected_user_id'),$request->input('user_id'),'invite_existing_officer',null);

    			return 'success';
    			
    		}
    	} else if($request->input('roles_id') == '3') { // VIP 

    		$user = agency_officer::where('user_id', $request->input('selected_user_id'))->where('status', '!=', '-1')->get();
    		$is_vip = special_user::where('user_id', $request->input('selected_user_id'))->where('event_id',$request->input('event_id'))->get();

    		if($is_vip->count()){ // if VIP status found associate with user, return VIP status
    			return 'vip';
    		} else if($user->count()){ // if this user already been added previously, then can't be add anymore

    			return 'officer';
    			
    		} else {

                if(!special_user::where('event_id',$request->input('event_id'))->where('user_id',$request->input('selected_user_id'))->exists()){
                    special_user::create([
                        'event_id'  => $request->input('event_id'),
                        'user_id'   => $request->input('selected_user_id'),
                        'status_id' => 0,
                    ]);
                    
                    $this->notify->generate_notification(
                        $request->input('selected_user_id'),$request->input('user_id'),
                        'invite_existing_vip',$request->input('event_id')
                    );
                    
                    return 'success';
                } else {
                    return 'exists';
                }
    			
    			
    			
    		}
    	}

    }

    public function list_officer(Request $request){

    	$officer = agency_officer::with('user')->where('agency_user_id', $request->input('user_id'))->where('status', '1')->get();
    	return compact('officer');

    }

    public function list_pending_officer(Request $request){
    	$pendingOfficer = agency_officer::with('user')->where('agency_user_id', $request->input('user_id'))->where('status', '0')->get();
    	return compact('pendingOfficer');
    }

    public function search_vip(Request $request){

        $user_id = $request->input('user_id');
        $query = $request->input('email');

        $user = User::where('email', $query)->first();
        
        if($user){

            $is_officer = agency_officer::where('user_id', $user->id)->where('agency_user_id', $user_id)->get();

            if(count($is_officer) > 0){
                return 'is_offier';
            }

        } else {

            return 'no_user_found';
        }
    }

    public function list_vip(Request $request){

    	$vip = special_user::where('event_id', $request->input('event_id'))->where('status', '1')->get();
    	return compact('vip');

    }

    public function agree_officer(Request $request){
    	$user = agency_officer::find($request->input('request_id'));
    	$user->status = 1;
    	$user->update();
    	return compact('user');
    }

    public function agree_vip(Request $request){
    	$user = special_user::find($request->input('request_id'));
    	$user->status = 1;
    	$user->update();
    	return compact('user');
    }

    public function disagree_officer(Request $request){
    	agency_officer::where('id', $request->input('request_id'))->delete();
    	return 'success';
    }

    public function disagree_vip(Request $request){
    	special_user::where('id', $request->input('request_id'))->delete();
    	return 'success';
    }

    public function confirm_reject_request(Request $request){

        $type = $request->input('type');
        $user_id = $request->input('user_id');
        $response = $request->input('answer');
        $notification_id = $request->input('notification_id');

        switch ($type) {

            case 'invite_existing_officer':
                
                if($response == 'accept'){
                    $info = agency_officer::where('user_id',$user_id)->update(['status' => '1']);
                    User::where('id',$user_id)->update(['roles_id' => '2']);
                    user_to_roles::where('user_id',$user_id)->update(['roles_id' => '2']);
                    $this->update_invited_status($notification_id, 'accepted_existing_officer');
                    return 'success';
                } else {
                    $info = agency_officer::where('user_id',$user_id)->delete();
                    User::where('id',$user_id)->update(['roles_id' => '5']);
                    user_to_roles::where('user_id',$user_id)->update(['roles_id' => '5']);
                    $this->update_invited_status($notification_id, 'rejected_existing_officer');
                    return 'removed';
                }

                break;

            case 'assign_agency_user':

                if($response == 'accept'){
                    $info = agency_user::where('user_id',$user_id)->update(['status' => '1']);
                    User::where('id',$user_id)->update(['roles_id' => '4']);
                    user_to_roles::where('user_id',$user_id)->update(['roles_id' => '4']);
                    $this->update_invited_status($notification_id, 'accepted_existing_officer');
                    return 'success';
                } else {
                    $info = agency_user::where('user_id',$user_id)->delete();
                    User::where('id',$user_id)->update(['roles_id' => '5']);
                    user_to_roles::where('user_id',$user_id)->update(['roles_id' => '5']);
                    $this->update_invited_status($notification_id, 'rejected_existing_officer');
                    return 'removed';
                }

                break;

            case 'invite_existing_vip':

                if($response == 'accept'){
                    $info = special_user::where('user_id',$user_id)->where('event_id',$request->input('event_id'))->update(['status_id' => '1']);
                    $this->update_invited_status($notification_id, 'accepted_existing_vip');
                    return 'success';
                } else {
                    $info = special_user::where('user_id',$user_id)->where('event_id',$request->input('event_id'))->update(['status_id' => '0']);
                    $this->update_invited_status($notification_id, 'rejected_existing_officer');
                    return 'removed';
                }

                break;

        }

    }

    private function update_invited_status($notification_id, $action_type){
        $notification = notification::find($notification_id);
        $notification->action_type = $action_type;
        $notification->update();
    }
}
