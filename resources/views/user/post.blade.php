@extends('layout.main')
@section('style')
<style>
#tags{
    border: 1px solid gray;
    border-radius: 7px;
    margin: 5px;
    padding: 0px 5px;
}
a{
    text-decoration: none !important;
    color: black !important;
}

img{
    width: 100%;
    height: auto;
}

#deleteBtn, .like{
    border: none;
    background: none;
}
</style>
@endsection
@section('content')
<div class="container d-flex">
    <div class="col-md-8">
        <div class="">
            <button type="button" onclick="history.back()" class="btn btn-info">Back</button>
        </div>
        <div class="">
            <strong><h3>{{$post->title}}</h3></strong>
        </div>
        <div class="">
            <p>Posted by <i>{{$post->user->name}}</i>
            in <i>{{$post->category->category}}</i>
            at <i>{{$post->created_at}}</i></p>
        </div>
        <div class="">
            <img src="{{$post->front_page_image_path}}" alt="">
        </div>
        <div class="">
            <div>{!!$post->content!!}</div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                @foreach ($post->tags as $tag )
                <a href="{{route('postTag',$tag->id)}}">
                    <div id="tags" class="">{{$tag->name}}</div>
                </a>
                @endforeach
            </div>
            <div class="d-flex">
                @auth
                    @if (Auth::user()->hasLikedPost($post->id))
                    <form action="{{route('unlike',$post->id)}}" method="post">
                        @csrf
                        <button type="submit" class="like">
                            <i class="fs-3 fa-solid fa-heart"></i>
                        </button>
                    </form>
                    @else
                    <form action="{{route('like',$post->id)}}" method="post">
                        @csrf
                        <button type="submit" class="like">
                            <i class="fs-3 fa-regular fa-heart"></i>
                        </button>
                    </form>
                    @endif
                @else
                    <a href="{{route('login')}}">
                        <i class="fs-3 fa-regular fa-heart"></i>
                    </a>
                @endauth
                <div><p class="fs-4">{{$post->likePost()->count()}}</p></div>
            </div>
        </div>
        <div>
            <div>
                <p><h4><i>Comments</i></h4></p>
                @auth
                <form action="{{route('pComment',$post->id)}}" method="post">
                    @csrf
                    <textarea name="content" class="form-control" id="comment" rows="3"></textarea>
                    <button type="submit" id="sendBtn" class="btn btn-primary">Send</button>
                </form>
                @else
                <p><i>You must login to comment !</i></p>
                @endauth
            </div>
            <div>
            @foreach ($post->comments as $comment)
                @if ($comment->status=="Published")
                <hr>
                <div class="w-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-primary fw-bold mb-0">
                        {{$comment->users->name}}
                        <span class="text-body ms-2">{{$comment->content}}</span>
                        </h6>
                        <p class="mb-0">{{$comment->created_at}}</p>
                    </div>
                    <div class="d-flex justify-content-start align-items-center">
                        <p class="small mb-0" style="color: #aaa;">
                            @auth
                            @if ($comment->users->id==Auth::id())
                            <form action="{{route('deleteComment',$comment->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button id="deleteBtn" class="text-center" type="submit">Remove</button>
                            </form>
                            @endif
                            @endauth
                        </p>
                    </div>
                </div>
                @endif
            @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4">

</div>
</div>
@endsection
