<?php

namespace App\Observers;

use App\Enums\Status;
use App\Enums\UserRole;
use App\Models\SendNotifications;
use App\Models\User;
use App\Notifications\SendNotification;
use Illuminate\Support\Facades\DB;
use App\Helper\SendNotificationHelper;
use Illuminate\Support\Facades\Notification;

class SendNotificationObserver
{
    /**
     * Handle the SendNotification "created" event.
     */
    public function created(SendNotifications $sendNotifications): void
    {
        // if ($sendNotifications->send_date<=now()) {
        //     Notification::sendNow($notificat)
        // }
    }

    /**
     * Handle the SendNotification "updated" event.
     */
    public function updated(SendNotifications $sendNotifications): void
    {
        //
    }

    /**
     * Handle the SendNotification "deleted" event.
     */
    public function deleted(SendNotifications $sendNotifications): void
    {
        //
    }

    /**
     * Handle the SendNotification "restored" event.
     */
    public function restored(SendNotifications $sendNotifications): void
    {
        //
    }

    /**
     * Handle the SendNotification "force deleted" event.
     */
    public function forceDeleted(SendNotifications $sendNotifications): void
    {
        DB::table('notifications')
        ->where('data',json_encode(array("title"=>$sendNotifications->title,"msg"=>$sendNotifications->msg)))
        ->delete();
    }

   
}
