<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user_to_roles;
use App\Model\agency;
use App\Model\events;
use Carbon\Carbon;
use Auth;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        //defining our middleware for this controller
        $this->middleware('auth',['except' => ['logout']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no_of_agency = agency::where('status','1')->count();
        $no_of_event = events::count();
        $no_of_apps_user = user_to_roles::whereIn('roles_id',[2,3,4,5])->count();

        $now = Carbon::now();

        $no_ongoing_event = events::where('status_id',0)->count();
        $no_completed_event = events::where('status_id',1)->count();
        $month_user = user_to_roles::whereIn('roles_id',[2,3,4,5])->whereMonth('created_at', $now->month)->count();
        $hot_category = DB::table('events')->select(DB::raw('category_id, count(*) as count'))
                        ->groupBy('category_id')->orderBy('count','DESC')->limit(1)->get();

        $graph = $this->get_graph();

        $data = array();
        $data['total_agency']       = $no_of_agency;
        $data['total_event']        = $no_of_event;
        $data['total_app_user']     = $no_of_apps_user;
        $data['ongoing_event']      = $no_ongoing_event;
        $data['completed_event']    = $no_completed_event;
        $data['monthly_user']       = $month_user;
        $data['hot_category']       = $hot_category;
        $data['user']               = Auth::user();

        return view('home', compact('data', 'graph'));
    }

    public function get_graph(){

        $data = array();

        $data['colors'] = array('#7cb5ec', '#f7a35c');
        $data['chart']['type'] = 'column';
        $data['chart']['renderTo'] = 'chartsss';
        $data['title'] = 'Monthly Events';
        $data['subtitle'] = 'Complete/ Ongoing Event';
        $data['xAxis']['categories'] = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
        $data['xAxis']['crosshair'] = true;
        $data['yAxis']['min'] = 0;
        $data['yAxis']['title']['text'] = 'Number of Event';
        $data['tooltip']['headerFormat'] = '<span style = "font-size:10px">{point.key}</span><table>';
        $data['tooltip']['pointFormat'] = '<tr><td style = "color:{series.color};padding:0">{series.name}: </td>' + '<td style = "padding:0"><b>{point.y:.1f} mm</b></td></tr>';
        $data['tooltip']['footerFormat'] = '</table>';
        $data['tooltip']['shared'] = true;
        $data['tooltip']['useHTML'] = true;
        $data['plotOptions']['column']['pointPadding'] = 0.2;
        $data['plotOptions']['column']['borderWidth'] = 0;


        $data['series'][0]['name'] = 'Completed Event';
        $data['series'][0]['data'] = [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4];

        $data['series'][1]['name'] = 'Ongoing Event';
        $data['series'][1]['data'] = [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3,91.2, 83.5, 106.6, 92.3];

        $data['credits'] = false;

        return $data;

    }
}
