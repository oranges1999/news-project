<?php

namespace App\Models;

use App\Enums\Status;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

// Observe by PostObserver, declared in EventServiceProvider
class Post extends Model
{
    use HasFactory, SoftDeletes, Notifiable, Filterable;

    protected $fillable =[
        'title',
        'content',
        'user_id',
        'category_id',
        'publish_at',
        'status',
        'front_page_image_path'
    ];

    protected $casts = [
        'status'=>Status::class
    ];

    public function category(){
        return $this->belongsTo(Categories::class,'category_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags(){
        return $this->belongsToMany(Tags::class,'post_tag','post_id','tag_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
