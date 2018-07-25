<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\invitation;
use Carbon\Carbon;
use DB;

class RemindRegisteredEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RemindRegisteredEvent:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminder to user who join the events tomorrow';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now()->addDay();
        $event_id = DB::table('events')->whereRaw('DATE(start_time) = ?', [ $now->toDateString()] )->pluck('id');
        $data = DB::table('events')->whereRaw('DATE(start_time) = ?', [ $now->toDateString()] )->get();
        $attendees = DB::table('event_attendees')->whereIn('event_id',$event_id)->distinct()->get();

        foreach ($attendees as $key => $attendee) {

            $users = DB::table('users')->where('id',$attendee->user_id)->get();
            $events = DB::table('events')->where('id',$attendee->event_id)->get();
            $location = DB::table('event_location')->where('id',$events[0]->location_id)->get();

            echo "<pre>";
            print_r( $users );
            print_r( $events );
            echo "</pre>";

            $objDemo = new \stdClass();
            $objDemo->title = $events[0]->title;
            $objDemo->description = $events[0]->description;
            $objDemo->start_time = $events[0]->start_time;
            $objDemo->end_time = $events[0]->end_time;
            $objDemo->location = $location[0]->name;
            $objDemo->address = $location[0]->address;
            $objDemo->sender = 'Kuching IT Solution - Event Management Team';
            $objDemo->receiver = $users[0]->name;
 
            Mail::to($users[0]->email)->send(new invitation($objDemo));

        }
    }
}
