<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Http\Controllers\Controller;

class ShowPostController extends Controller
{
    public function show(Post $post)
    {
        return view('user.post',compact('post'));
    }
}
