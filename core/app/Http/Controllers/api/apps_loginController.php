<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\user_to_roles;
use App\User;

class apps_loginController extends Controller
{
    public function auth(Request $request){

    	$name = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $name, 'password' => $password])) {
        	$roles = User::with('roles_name')->where('id',Auth::user()->id)->get();
            return json_encode(["status" => "success", "data" => Auth::user(), "roles" => $roles]);
        } else 
        	return "fail";

    }

    public function register(Request $request){

    	$email = $request->input('email');
    	$password = $request->input('password');
    	$username = $request->input('username');

        $is_exists = User::where('email', $email)->count();

        if($is_exists > 0){
            return "exists";
        }

    	$user = User::create([
            'name' => $username,
            'email' => $email,
            'password' => bcrypt($password),
            'roles_id'  => '5',
            'status'  => '1'
        ]);

        user_to_roles::create([
            'user_id'   => $user->id,
            'roles_id'  => '5',
        ]);

        $roles = user_to_roles::with('roles_name')->where('user_id',$user->id)->get();
        return json_encode(["status" => "success", "data" => $user, "roles" => $roles]);
    }

    public function update_profile(Request $request){

        $user_id = $request->input('user_id');
        $action_type = $request->input('type');
        $info = $request->input('info');
        $user = User::find($user_id);

        switch ($action_type) {
            case 'username':
                $user->name = $info;
                $user->update();
                break;
            
            case 'password':
                $user->password = bcrypt($info);
                $user->update();
                break;
        }

        return compact('user');
    }
}