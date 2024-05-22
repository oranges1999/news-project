<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post){
        $post->likePost()->attach(Auth::id());
        return redirect()->back();
    }

    public function unlike(Post $post){
        $post->likePost()->detach(Auth::id());
        return redirect()->back();
    }
}
