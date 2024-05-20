<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Models\SendNotifications;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\SendNotificationRequest;
use App\Http\Requests\Notification\UpdateNotificationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receivedNotifications=[];
        $notifications=[];
        if(Auth::user()->role === UserRole::Admin){
            $receivedNotifications = Auth::user()->notifications;
            $notifications = SendNotifications::all();
        }else{
            $receivedNotifications = Auth::user()->notifications;
        }
        return view('admin.notification.index', compact('receivedNotifications','notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id','name')->get();
        return view('admin.notification.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SendNotificationRequest $request)
    {
        $data = $request->validated();
        $data = array_merge($data,['status'=>'pending']);
        SendNotifications::create($data);
        return redirect()->route('admin.notification.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SendNotifications $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SendNotifications $notification)
    {
        $users = User::select('id','name')->get();
        return view('admin.notification.edit',compact('notification','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, SendNotifications $notification)
    {
        $data = $request->validated();
        $notification->update($data);
        return redirect()->route('admin.notification.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SendNotifications $notification)
    {
        $notification->forceDelete();
        return redirect()->route('admin.notification.index');
    }
}
