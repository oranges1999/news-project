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
<div class="container d-flex justify-content-center flex-wrap">
    @foreach ($posts as $post)
    <a href="{{route('showPost',$post->id)}}">
        <div class="post px-4 py-3">
            <img class="title-image" src="{{$post->front_page_image_path}}" alt="">
            <div>{{$post->title}}</div>
            <div><p class="">Author: <i>{{$post->user->name}}</i></p></div>
            <div><p>Category: <i>{{$post->category->category}}</i></p></div>
        </div>
    </a>
    @endforeach
</div>
@endsection

