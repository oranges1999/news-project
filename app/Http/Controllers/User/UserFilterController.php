<?php

namespace App\Http\Controllers\User;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModelFilters\UserPostFilter;
use App\Models\Categories;
use App\Models\Post;
use App\Models\Tags;
use App\Models\User;

class UserFilterController extends Controller
{
    public function filter(Request $request){
        // dd($request->all());
        $authors = User::where('role',UserRole::Admin)->orWhere('role',UserRole::Writer)->get();
        $categories = Categories::all();
        $tags = Tags::all();
        $posts = Post::filter($request->all(),UserPostFilter::class)->get();
        return view('user.filter',compact('categories','tags','posts','authors'));
    }
}
