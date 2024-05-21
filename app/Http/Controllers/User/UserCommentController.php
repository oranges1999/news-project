<?php

namespace App\Http\Controllers\User;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class UserCommentController extends Controller
{
    public function store(CreateCommentRequest $request, Post $post){
        $comment = $request->validated();
        $comment = array_merge($comment,['user_id'=>Auth::id(),'status'=>Status::Pending]);
        $comment = $post->comments()->create($comment);
        return redirect()->back()->with('success','Your comment has been sent and waiting for admin to confirm');
    }
    public function destroy(Comment $comment){
        $comment->delete();
        return redirect()->back();   
    }
}
