<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\events;
use App\Model\agency;
use App\Model\category;
use App\Model\roles;
use App\Model\agency_user;
use App\User;
use Excel,DB,Auth;

class eventReportController extends Controller
{
	public function index(){

		return view('reporting.index');

	}

    public function monthly()
    {
    	$categories = category::all();
    	$data = array();
    	$data[0] = ['Category \ Month', 'JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','TOTAL'];
    	$count = 1;
    	$monthly = array();
        DB::enableQueryLog();

    	foreach ($categories as $key => $category) {

            // echo "Category id: " . $category->id . '<br />';
    		for ($i=1; $i <= 12 ; $i++) {
    			$monthly[$i-1] = $this->get_month_data($i,date("Y"),0,$category->id);
    		}

            if(Auth::user()->roles_id == 1)
    		    $total = events::where('status_id',0)->where('category_id',$category->id)->count();
            else if(Auth::user()->roles_id == 4){
                $total = events::where('status_id',0)->where('category_id',$category->id)->where('agency_id',Auth::user()->id)->count();
            }

    		$data[$count] = [
    			$category->category_name,
	            $monthly[0][0]->event, $monthly[1][0]->event, $monthly[2][0]->event,
	            $monthly[3][0]->event, $monthly[4][0]->event, $monthly[5][0]->event,
	            $monthly[6][0]->event, $monthly[7][0]->event, $monthly[8][0]->event,
	            $monthly[9][0]->event, $monthly[10][0]->event, $monthly[11][0]->event,
	            $total
	        ];

    		$count ++;
    	}

    	// Generate and return the spreadsheet
	    Excel::create('monthly_report', function($excel) use ($data) {

	        // Set the spreadsheet title, creator, and description
	        $excel->setTitle('Monthly Report');
	        $excel->setCreator('KuchingIT Developer')->setCompany('KuchingITSolution');
	        $excel->setDescription('Event Monthly reporting file');

	        // Build the spreadsheet, passing in the payments array
	        $excel->sheet('sheet1', function($sheet) use ($data) {
	            $sheet->fromArray($data, null, 'A1', true, false);
	        });

	    })->download('xlsx');

        //return view('reporting.monthly')->download('invoices.xlsx');;
    }

    public function agency_report(){

    	$agencies = agency::all();
    	$data = array();
    	$data[0] = ['Agency \ Month', 'JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','TOTAL'];
    	$count = 1;
    	$monthly = array();

    	foreach ($agencies as $key => $agency) {
    		$agency_user = agency_user::where('agency_id',$agency->id)->pluck('user_id');

    		for ($i=1; $i <= 12 ; $i++) {
    			$monthly[$i-1] = $this->get_agency_month_data($i,date("Y"),0,$agency_user);
    		}

    		$total = events::where('status_id',0)->whereIn('agency_id',$agency_user)->count();

    		$data[$count] = [
    			$agency->name,
	            $monthly[0][0]->event, $monthly[1][0]->event, $monthly[2][0]->event,
	            $monthly[3][0]->event, $monthly[4][0]->event, $monthly[5][0]->event,
	            $monthly[6][0]->event, $monthly[7][0]->event, $monthly[8][0]->event,
	            $monthly[9][0]->event, $monthly[10][0]->event, $monthly[11][0]->event,
	            $total
	        ];

	        $count++;
    	}

		// Generate and return the spreadsheet
	    Excel::create('agency_report', function($excel) use ($data) {

	        // Set the spreadsheet title, creator, and description
	        $excel->setTitle('Agency Monthly Report');
	        $excel->setCreator('KuchingIT Developer')->setCompany('KuchingITSolution');
	        $excel->setDescription('Agency Monthly reporting file');

	        // Build the spreadsheet, passing in the payments array
	        $excel->sheet('sheet1', function($sheet) use ($data) {
	            $sheet->fromArray($data, null, 'A1', true, false);
	        });

	    })->download('xlsx');


    }

    public function app_user_report(){

    	$roles = roles::all();
    	$data = array();
    	$data[0] = ['App User \ Month', 'JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','TOTAL'];
    	$count = 1;
    	$monthly = array();

    	foreach ($roles as $key => $role) {

    		if($role->id == 3 || $role->id == 1) continue;

    		for ($i=1; $i <= 12 ; $i++) {
    			$monthly[$i-1] = $this->get_user_month_data($i,date("Y"),0,$role->id);
    		}

    		$total = User::where('roles_id', $role->id)->count();    

    		$data[$count] = [
    			$role->roles_name,
	            $monthly[0][0]->event, $monthly[1][0]->event, $monthly[2][0]->event,
	            $monthly[3][0]->event, $monthly[4][0]->event, $monthly[5][0]->event,
	            $monthly[6][0]->event, $monthly[7][0]->event, $monthly[8][0]->event,
	            $monthly[9][0]->event, $monthly[10][0]->event, $monthly[11][0]->event,
	            $total
	        ];

    		$count ++;
						
    	}

        exit();

    	// Generate and return the spreadsheet
	    Excel::create('app_user_report', function($excel) use ($data) {

	        // Set the spreadsheet title, creator, and description
	        $excel->setTitle('App User Monthly Report');
	        $excel->setCreator('KuchingIT Developer')->setCompany('KuchingITSolution');
	        $excel->setDescription('App User Monthly reporting file');

	        // Build the spreadsheet, passing in the payments array
	        $excel->sheet('sheet1', function($sheet) use ($data) {
	            $sheet->fromArray($data, null, 'A1', true, false);
	        });

	    })->download('xlsx');

    }

    private function get_month_data($month, $year, $status_id, $category_id){

        $data = DB::table('events')
                 ->select(DB::raw('count(*) as event'))
                 ->whereRaw('status_id = ?', [$status_id])
                 ->whereRaw('category_id = ?', [$category_id])
                 ->whereRaw('MONTH(end_time) = ?', [$month])
                 ->whereRaw('YEAR(end_time) = ?',[$year])
                 ->get();

        // echo "<pre>";
        // echo "Month: " . $month . " <br />category_id: " . $category_id . '<br />';
        // print_r(DB::getQueryLog());
        // // print_r($data);
        // echo "</pre>";

        return $data;
    }

    private function get_agency_month_data($month, $year, $status_id, $agency_user){

        $data = DB::table('events')
                 ->select(DB::raw('count(*) as event'))
                 ->whereRaw('status_id = ?', [$status_id])
                 ->whereIn('agency_id', $agency_user)
                 ->whereRaw('MONTH(end_time) = ?', [$month])
                 ->whereRaw('YEAR(end_time) = ?',[$year])
                 ->get();

        return $data;
    }

    private function get_user_month_data($month, $year, $status_id, $roles_id){

        $data = DB::table('users')
                 ->select(DB::raw('count(id) as event'))
                 ->whereRaw('status = ?', [$status_id])
                 ->whereRaw('roles_id = ?', [$roles_id])
                 ->whereRaw('MONTH(created_at) = ?', [$month])
                 ->whereRaw('YEAR(created_at) = ?',[$year])
                 ->get();

        return $data;
    }
}
