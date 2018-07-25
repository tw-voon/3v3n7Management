<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\events;
use App\Model\agency;
use App\Model\agency_user;
use Validator, Redirect;
use Auth;

class agencyController extends Controller
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
    	return view('agency.create');
    }

    public function store(Request $request){

    	$validator = Validator::make($request->all(), [
            'name' => 'required|unique:event_agency,name',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return Redirect::to('new_agency')->withErrors($validator);
        }

        $agency = agency::create([
        	'name' 			=> $request->input('name'),
        	'description'	=> $request->input('description'),
        	'status'		=> 1
        ]);

        if($agency){
        	return Redirect::to('/agency/edit/'.$agency->id);
        }

    }

    public function edit(Request $request, $id){

    	$agency = agency::find($id);
        $agency_user = agency_user::with('user')->where('agency_id',$id)->get();
        $agency_id = agency_user::where('agency_id',$id)->pluck('user_id');
        $event_helded = events::whereIn('agency_id',$agency_id)->count();
        $ongoing = events::whereIn('agency_id',$agency_id)->where('status_id','1')->count();
        $completed = events::whereIn('agency_id',$agency_id)->where('status_id','0')->count();

    	return view('agency.edit', compact('agency', 'agency_user', 'event_helded', 'ongoing', 'completed'));

    }

    public function update(Request $request, $id){

    	$validator = Validator::make($request->all(), [
            'name' => 'required|unique:event_agency,name,'.$id,
            'description' => 'required'
        ]);

        if($validator->fails()){
            return Redirect::to('new_agency')->withErrors($validator);
        }

        $agency = agency::find($id);
        $agency->name = $request->input('name');
        $agency->description = $request->input('description');
        $agency->update();

        if($agency){
        	return Redirect::to('/agency/edit/'.$agency->id);
        }

    }
}
