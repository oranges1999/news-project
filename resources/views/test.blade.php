<?php

// use Illuminate\Support\Facades\Auth;

// $path = 'media/'.Auth::id();
// $path = public_path($path);
// dd($path);

use App\Models\SendNotifications;

$notifications=SendNotifications::where('send_date','<=',now())->where('status','pending')->toRawSql();
echo $notifications;
// dd($notifications);