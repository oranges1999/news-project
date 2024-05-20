<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Stringable;

class AdminHomeController extends Controller
{
    public function index(){
        $notifications = Auth::user()->unreadNotifications;
        return view('admin.home',compact('notifications'));
    }

    public function markOneAsRead(Request $request)
    {   
        Auth::user()->unreadNotifications->where('id',$request->id)->markAsRead();
        return redirect()->back();
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
