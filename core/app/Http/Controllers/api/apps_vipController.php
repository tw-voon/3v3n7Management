<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\events;
use App\Model\user_to_roles;
use App\Model\special_user;
use App\User;
use Auth;

class apps_vipController extends Controller
{
    public function search_vip(Request $request){
    	// search whether this user exists
    	return User::where('email', $request->input('email'))->get();
    }

    public function add_vip(Request $request){
    	// add the request to the special user table
    	return special_user::create([
    		'event_id' 	=> $request->input('event_id');
    		'user_id' 	=> $request->input('user_id'),
    		'roles_id' 	=> $request->input('roles_id'),
    		'status_id' => 0,
    	]);
    }

    public function select_vip(Request $request){

    }

    public function agree_vip(Request $request){
    	$user = special_user::where('user_id', $request->input('user_id'))->where('event_id', $request->input('event_id'))->first();
    	$user->status_id = 1;
    	$user->update();
    	return compact('user');
    }
}
