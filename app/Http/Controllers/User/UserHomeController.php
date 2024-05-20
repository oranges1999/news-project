<?php

namespace App\Http\Controllers\User;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Post;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function __invoke()
    {
        $categories = Categories::all();
        $posts = Post::where('status',Status::Publish)->get();
        return view('user.homepage',compact('categories','posts'));
    }
}
