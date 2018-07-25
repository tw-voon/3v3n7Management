<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\notification;
use App\User;

class apps_eventNotificationController extends Controller
{

    public function store_notification(){

    }

    public function remove_notification(){

    }

    public function get_notification(Request $request){

    	$user_id = $request->input('user_id');
    	$notification = notification::where('specific_user_id', $user_id)->orderBy('created_at', 'DESC')->get();
    	return compact('notification');

    }

}
