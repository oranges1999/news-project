<?php

// use Illuminate\Support\Facades\Auth;

// $path = 'media/'.Auth::id();
// $path = public_path($path);
// dd($path);

use App\Models\SendNotifications;
use App\Models\Comment;
use App\Enums\Status;

$comments = Comment::all();
foreach ($comments as $comment) {
    
    if($comment->status == "Pending"){
        echo "true";
    }else{
        echo "false";
    }
    dd($comment->status);
};


// dd($notifications);