<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\info;
use Auth;

class eventAppsInfo extends Controller
{
    public function index(){

    	$info = info::find(1);
    	return view('info.index', compact('info'));

    }

    public function store(Request $request){

    	$exist = count(info::all());
    	$info = $request->all();

    	// echo "<pre>";
    	// print_r(htmlentities($info['info_text']));
    	// echo "</pre>";

    	if($exist){
    		$item = info::find(1);
    		$item->source = htmlentities($info['info_text']);
    		$item->update();
    	} else {
    		$item = new info();
    		$item->source = htmlentities($info['info_text']);
    		$item->save();
    	}

    	return redirect()->route('info.index');
    }

    public function profile(){

        if(Auth::check()){
            return view('profile.info');
        } else {
            return redirect()->route('/login');
        }
    }

}
