<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Observe by SendNotificationObserver, declared in EventServiceProvider
class SendNotifications extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'send_notifications';

    protected $fillable =[
        'title',
        'msg',
        'type',
        'receiver_id',
        'send_date',
        'status'
    ];

    protected $casts = [
        'receiver_id'=>'array'
    ];
}
