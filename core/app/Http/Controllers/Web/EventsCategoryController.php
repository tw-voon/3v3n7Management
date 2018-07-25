<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\category;
use Validator,Auth,Redirect;

class EventsCategoryController extends Controller
{

	public function __construct()
    {
        //defining our middleware for this controller
        $this->middleware('auth');
    }

    public function index(){

    	$categories = category::paginate(10);
    	return view('event_category.index', compact('categories'));

    }

    public function create(Request $request){

    	return view('event_category.create');

    }

    public function edit(Request $request, $id){

    	$category = category::find($id);
    	return view('event_category.edit', compact('category'));

    }

    public function store(Request $request){

    	$validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:event_categories,category_name'
        ]);

        if($validator->fails()){
            return Redirect::to('events_category/new')->withErrors($validator);
        }

        $category = category::create([
        	'category_name' 	=> $request->input('category_name')
        ]);

        if($category){
        	return Redirect::to('events_category/edit/'.$category->id);
        }

    }

    public function update(Request $request, $id){

    	$validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:event_categories,category_name,'.$id
        ]);

        if($validator->fails()){
            return Redirect::to('events_category/edit/'.$id)->withErrors($validator);
        }

        $category  = category::find($id);
        $category->category_name = $request->input('category_name');
        $category->update();

        if($category){
        	return Redirect::to('events_category/edit/'.$id);
        }

    }
}
