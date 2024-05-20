<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

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
