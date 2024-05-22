<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'path',
        'user_id',
        'original_name'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->belongToMany(Post::class,'post_image','image_id','post_id');
    }
}
