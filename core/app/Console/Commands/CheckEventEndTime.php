<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class CheckEventEndTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckEventEndTime:change_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the event end time and set complete status';

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
        //toDateTimeString()
        $data = DB::table('events')
                 ->select('*')
                 ->whereRaw('end_time <= ?', [Carbon::now()->toDateTimeString()])
                 ->update(['status_id' => 0]);
    }
}
