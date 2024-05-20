<?php

namespace App\Helper;

use App\Enums\Status;
use App\Enums\UserRole;
use App\Models\SendNotifications;
use App\Models\User;
use App\Notifications\SendNotification;

class SendNotificationHelper
{
    public function send(SendNotifications $sendNotifications)
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
