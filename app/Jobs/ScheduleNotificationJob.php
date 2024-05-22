<?php

namespace App\Jobs;

use App\Enums\UserRole;
use App\Helper\SendNotificationHelper;
use App\Models\SendNotifications;
use App\Models\User;
use App\Notifications\SendNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScheduleNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notifications;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->notifications = SendNotifications::where('send_date','<=',now())->where('status','pending')->get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->notifications as $notification){
            $this->send($notification);
        }
    }

    private function send(SendNotifications $sendNotifications)
    {
        $sendNotifications->update(array('status'=>'sent'));
        switch ($sendNotifications->type)
        {
            case 'other':
                foreach ($sendNotifications->receiver_id as $user_id) {
                    $user = User::find($user_id);
                    $user->notify(new SendNotification($sendNotifications));
                }
                break;
            case 'writer':
                foreach (User::where('role',UserRole::Writer)->get() as $user) {
                    $user->notify(new SendNotification($sendNotifications));
                }
                break;
            case 'user':
                foreach (User::where('role',UserRole::User)->get() as $user) {
                    $user->notify(new SendNotification($sendNotifications));
                }
                break;
            default:
                foreach (User::all() as $user) {
                    $user->notify(new SendNotification($sendNotifications));
                }
                break;
        }
    }
}
