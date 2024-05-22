<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Enums\UserRole;
use App\Helper\RoleHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\ModelFilters\AdminPostFilter;
use App\Models\Categories;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class,'post');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $authors = User::where('role',UserRole::Admin)->orWhere('role',UserRole::Writer)->get();
        $categories = Categories::all();
        $status = [Status::Pending, Status::Publish];
        $posts = Post::filter($request->all(),AdminPostFilter::class)->get();
        return view('admin.post.index',compact('posts','categories','status', 'authors'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $images = Image::where('user_id',Auth::id())->get();
        $categories = Categories::select('id','category')->get();
        return view('admin.post.create', compact('categories', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $tags = $request->safe()->only('tags');
        $post = $request->safe()->except('tags');
        $post = array_merge($post,['user_id'=>Auth::id(),'status'=>Status::Pending]);

        $post = Post::create($post);
        foreach ($tags as $key => $value) {
            $post->tags()->attach($value);
        }

        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $images = Image::where('user_id',Auth::id())->get();
        $categories = Categories::select('id','category')->get();
        return view('admin.post.edit', compact('post','categories','images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $updateData = $request->validated();
        dd($updateData);

        $updateData = $request->safe()->except('images');
        $images = $request->safe()->only('images');

        $post->update($updateData);
        if(!empty($images)){
            $this->storeImage($images,$post);
        }

        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.post.index');
    }
}
