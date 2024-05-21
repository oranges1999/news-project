<?php

namespace App\Models;

use App\Enums\Status;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $table = 'comment';

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'status',
    ];

    protected $cast = [
        'status' => Status::class,
    ];

    public function isPending(){
        return $this->status===Status::Pending;
    }
    
    public function isPublish(){
        return $this->status===Status::Publish;
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function posts(){
        return $this->belongsTo(Post::class,'post_id');
    }
}
