<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tags;

class PostTagController extends Controller
{
    public function __invoke(Tags $tag)
    {
        return view('user.tag',compact('tag'));
    }
}
