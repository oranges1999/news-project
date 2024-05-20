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
</style>
@endsection
@section('content')
<div class="container">
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
    <div class="d-flex">
    @foreach ($post->tags as $tag )
        <a href="{{route('postTag',$tag->id)}}">
            <div id="tags" class="">{{$tag->name}}</div>
        </a>
    @endforeach
    </div>
</div>
@endsection