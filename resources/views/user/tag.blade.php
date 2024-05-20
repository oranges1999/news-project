@extends('layout.main')
@section('style')
<style>
.title-image{
    width: 300px;
    max-height: 100%;
}
p{
    margin: 0px !important;
}
a{
    text-decoration: none !important;
    color: black !important;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="d-flex justify-content-start">
        <div class="">
            <h4>Showing posts in <i><strong>{{$tag->name}}</strong></i> tag</h4>
            <p><i>Information about {{$tag->name}}</i></p>
        </div>
    </div>
    <div class="col-md-10">
        @foreach ($tag->posts as $post)
        @if ($post->publish_at < now())
        <a href="{{route('showPost',$post->id)}}">
            <div class="post px-4 py-3">
                <img class="title-image" src="{{$post->front_page_image_path}}" alt="">
                <div>{{$post->title}}</div>
                <div><p class="">Author: <i>{{$post->user->name}}</i></p></div>
                <div><p>Category: <i>{{$post->category->category}}</i></p></div>
            </div>
        </a>
        @endif
        @endforeach
    </div>
</div>
@endsection