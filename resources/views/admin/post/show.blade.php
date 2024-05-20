@extends('admin.homepage')
@section('styles')

@endsection
@section('content')
<div class="d-flex justify-content-end">
<a href="{{route('admin.post.edit',$post->id)}}">
    <button type="button" class="btn btn-warning">Edit</button>
</a>
</div>
<div class="container">
    <div class="d-flex justify-content-center">
        <strong><h3>{{$post->title}}</h3></strong>
    </div>
    <div class="d-flex justify-content-center">
        <p>Posted by <i>{{$post->user->name}}</i> 
        in <i>{{$post->category->category}}</i> 
        at <i>{{$post->created_at}}</i></p>
    </div>
    <div class="d-flex justify-content-center">
        <img src="{{$post->front_page_image_path}}" alt="">
    </div>
    <div class="d-flex justify-content-center">
        <div>{!!$post->content!!}</div>
    </div>
</div>
@endsection