<?php

namespace App\Console\Commands;

use App\Enums\Status;
use Illuminate\Console\Command;
use App\Helper\SendNotificationHelper;
use App\Jobs\ScheduleNotificationJob;
use App\Models\SendNotifications;

class ScheduleNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schedule-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan and send schedule notification every minute';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $notifications=SendNotifications::where('send_date','<=',now())->where('status','pending')->get();
        // foreach($notifications as $notification){
        //     (new SendNotificationHelper)->send($notification);
        // }
        ScheduleNotificationJob::dispatch();
    }
}
