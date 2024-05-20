<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SendNotification;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    protected function showUnread()
    {
        return Auth::user()->unreadNotifications; 
    }

    public function markOneAsRead($notification)
    {
        $notification->update([
            'read_at'=>now()
        ]);
        return redirect()->back();
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function adminNotification()
    {
        $notifications = $this->showUnread();
        return redirect()->route('admin.homepage',compact('$notifications'));
    }
}
