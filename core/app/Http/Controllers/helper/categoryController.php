<?php

namespace App\Http\Controllers\helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\category;

class categoryController extends Controller
{
    public function getAllCategory(){
    	return category::all();
    }
}
