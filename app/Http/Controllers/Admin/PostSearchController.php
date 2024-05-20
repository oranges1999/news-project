<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\ModelFilters\AdminPostFilter;
use App\Models\Categories;
use App\Models\Post;
use Illuminate\Http\Request;

class PostSearchController extends Controller
{
    public function search(Request $request){
        $categories = Categories::all();
        $status = [Status::Pending, Status::Publish];
        $post = Post::filter($request->all(),AdminPostFilter::class)->get();
        return view('admin.post.search',compact('post','categories','status'));  
    }
}
