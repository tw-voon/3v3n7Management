<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\agency;
use App\Model\agency_user;
use App\User;
use Redirect, Auth, Validator;

class AgencyApplicationController extends Controller
{
    public function __construct()
    {
        //defining our middleware for this controller
        $this->middleware('auth');
        
    }

    public function index(Request $request){

    	$agencies = agency::paginate(10);
    	return view('agency.index', compact('agencies'));

    }

    public function create(Request $request){

    	$requests = $request->input('agency_id');
    	return view('agency_application.create', compact('requests'));

    }

    public function edit(Request $request,$id){

    	$user = User::find($id);
    	$agencies = agency_user::with('agency')->where('user_id', $id)->get();

    	return view('agency_application.edit', compact('user', 'agencies'));

    }

    public function store(Request $request){

    	$validator = Validator::make($request->all(), [
            'name' 		=> 'required|unique:users,name',
            'email' 	=> 'required|unique:users,email',
            'password'	=> 'required'
        ]);

        if($validator->fails()){
            return Redirect::to('/agency/new_user')->withErrors($validator);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'status'    => 0,
            'roles_id'  => '4'
        ]);

        $under_agency = new agency_user();
        $under_agency->agency_id = $request->input('agency_id');
        $under_agency->user_id = $user->id;
        $under_agency->status = 1;
        $under_agency->save();

        if($user){
        	return Redirect::to('/agency/edit_user/'.$user->id);
        }

    }

    public function update(Request $request,$id){

    	$validator = Validator::make($request->all(), [
            'name' 		=> 'required|unique:users,name,'.$id,
            'email' 	=> 'required|unique:users,email,'.$id,
            'password'	=> 'required'
        ]);

        if($validator->fails()){
            return Redirect::to('/agency/new_user')->withErrors($validator);
        }

        $user = User::find($id);
        $user->name 	= $request->input('name');
        $user->email 	= $request->input('email');
        $user->update();

        if($user){
        	return Redirect::to('/agency/edit_user/'.$user->id);
        }

    }
}
