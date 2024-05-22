<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Observe by CategoriesObserver, declared in EventServiceProvider
class Categories extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category',
        'description'
    ];

    public function post(){
        return $this->hasMany(Post::class,'category_id');
    }
}
