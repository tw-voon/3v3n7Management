<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user_to_roles;
use App\Model\agency;
use App\Model\events;
use App\Model\category;
use App\User;
use Carbon\Carbon;
use Auth;
use DB;

class eventDashboardController extends Controller
{
	public function __construct()
    {
        //defining our middleware for this controller
        $this->middleware('auth');

    }

    public function index()
    {

        $no_of_agency = agency::where('status','1')->count();
        $no_of_event = events::count();
        $no_of_apps_user = User::whereIn('roles_id',[2,3,4,5,6])->count();

        $now = Carbon::now();

        $no_ongoing_event = events::where('status_id',1)->count();
        $no_completed_event = events::where('status_id',0)->count();
        $month_user = User::whereIn('roles_id',[2,3,4,5,6])->whereMonth('created_at', $now->month)->count();
        $hot_category = DB::table('events')->select(DB::raw('category_id, count(*) as count'))->groupBy('category_id')->orderBy('count','DESC')->limit(1)->get();
        // print_r($hot_category);
        $category = count($hot_category) == 0 ? 'No trending category' : category::find($hot_category[0]->category_id)->category_name;

        if(Auth::user()->roles_id == 1)
            $coming_events = events::with('media','locations')->whereRaw('DATE(end_time)>=DATE(NOW())')->orderBy('created_at', 'DESC')->limit(5)->get();
        else if(Auth::user()->roles_id == 4){
            $coming_events = events::with('media','locations')->where('agency_id',Auth::user()->id)->whereRaw('DATE(end_time)>=DATE(NOW())')->orderBy('created_at', 'DESC')->limit(5)->get();
        }

        $graph = $this->get_graph();

        $report = $this->get_month_data(4, 2018, 0);

        $data = array();
        $data['total_agency']       = $no_of_agency;
        $data['total_event']        = $no_of_event;
        $data['total_app_user']     = $no_of_apps_user;
        $data['ongoing_event']      = $no_ongoing_event;
        $data['completed_event']    = $no_completed_event;
        $data['monthly_user']       = $month_user;
        $data['hot_category']       = $category;
        $data['user']               = Auth::user();
        $data['coming_events']      = $coming_events;
        
        // echo "<pre>";
        // print_r(json_decode($graph));
        // echo "</pre>";

        return view('home', compact('data', 'graph', 'report'));
    }

    private function get_graph(){

        $data = array();

        $data['colors'] = array('#7cb5ec', '#f7a35c');
        $data['chart']['type'] = 'column';
        // $data['chart']['renderTo'] = 'chartsss';
        $data['title']['text'] = 'Monthly Events';
        $data['subtitle']['text'] = 'Complete/ Ongoing Event';
        $data['xAxis']['categories'] = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
        $data['xAxis']['crosshair'] = true;
        $data['yAxis']['min'] = 0;
        $data['yAxis']['title']['text'] = 'Number of Event';
        $data['plotOptions']['column']['pointPadding'] = 0.2;
        $data['plotOptions']['column']['borderWidth'] = 0;

        $completed = array();
        $ongoing = array();
        for ($i=1; $i <= 12 ; $i++) { 
            
            if(Auth::user()->roles_id == 1){
                $completed[$i-1] = $this->get_month_data($i,date("Y"),0);
                $ongoing[$i-1] = $this->get_month_data($i,date("Y"),1);
            } else if(Auth::user()->roles_id == 4){
                $completed[$i-1] = $this->get_agency_month_data($i,date("Y"),Auth::user()->id,0);
                $ongoing[$i-1] = $this->get_agency_month_data($i,date("Y"),Auth::user()->id,1);
            }

        }

        if(empty($completed_event)){
        	$data['credits'] = false;
        	$data['series'][0]['name'] = 'Completed Event';
        	$data['series'][0]['data'] = array();
        	$data['series'][1]['name'] = 'Ongoing Event';
        	$data['series'][1]['data'] = array();
        	return json_encode($data);
        }

        $data['series'][0]['name'] = 'Completed Event';
        $data['series'][0]['data'] = [
            (int)$completed[0][0]->event, (int)$completed[1][0]->event, (int)$completed[2][0]->event,
            (int)$completed[3][0]->event, (int)$completed[4][0]->event, (int)$completed[5][0]->event,
            (int)$completed[6][0]->event, (int)$completed[7][0]->event, (int)$completed[8][0]->event,
            (int)$completed[9][0]->event, (int)$completed[10][0]->event, (int)$completed[11][0]->event
        ];

        $data['series'][1]['name'] = 'Ongoing Event';
        $data['series'][1]['data'] = [
            (int)$ongoing[0][0]->event, (int)$ongoing[1][0]->event, (int)$ongoing[2][0]->event,
            (int)$ongoing[3][0]->event, (int)$ongoing[4][0]->event, (int)$ongoing[5][0]->event,
            (int)$ongoing[6][0]->event, (int)$ongoing[7][0]->event, (int)$ongoing[8][0]->event,
            (int)$ongoing[9][0]->event, (int)$ongoing[10][0]->event, (int)$ongoing[11][0]->event
        ];

        $data['credits'] = false;

        return json_encode($data);

    }

    private function get_month_data($month, $year, $status_id){

        $data = DB::table('events')
                 ->select(DB::raw('count(*) as event'))
                 ->whereRaw('status_id = ?', [$status_id])
                 ->whereRaw('MONTH(end_time) = ?', [$month])
                 ->whereRaw('YEAR(end_time) = ?',[$year])
                 ->get();

        return $data;
    }

    private function get_agency_month_data($month, $year, $agency_id, $status_id){

        $data = DB::table('events')
                 ->select(DB::raw('count(*) as event'))
                 ->whereRaw('status_id = ?', [$status_id])
                 ->whereRaw('agency_id = ?', [$agency_id])
                 ->whereRaw('MONTH(end_time) = ?', [$month])
                 ->whereRaw('YEAR(end_time) = ?',[$year])
                 ->get();

        return $data;
    }
}
