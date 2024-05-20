<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Post;

class PostCategoryController extends Controller
{
    public function __invoke(Categories $category)
    {
        return view('user.category',compact('category'));
    }
}
