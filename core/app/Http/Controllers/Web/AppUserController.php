<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user_to_roles;
use App\User;
use Auth,Validator,Redirect;

class AppUserController extends Controller
{
    public function index(){

    	$appsuser = User::with('roles_name')->whereIn('roles_id',[2,3,4,5])->paginate(10);
    	return view('app_user.index', compact('appsuser'));

    }

    public function edit(Request $request, $id){

    	$appsuser = User::with('roles_name')->where('id',$id)->get();
    	return view('app_user.edit', compact('appsuser'));

    }

    public function create(Request $request){
    	return view('app_user.create');
    }

    public function store(Request $request){

    	// echo "<pre>";
    	// print_r($request->all());
    	// echo "</pre>";

    	$user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'status'    => 1,
            'roles_id'  => '6'
        ]);

        if($user){
            return Redirect::to('/app_user/edit/'.$user->id);
        }
    
    }

}
