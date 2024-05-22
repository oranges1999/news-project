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
            <h4>Showing posts in <i><strong>{{$category->category}}</strong></i></h4>
            <p><i>{{$category->description}}</i></p>
        </div>
    </div>
    <div class="col-md-10 d-flex">
        @foreach ($category->post as $post)
            @if ($post->publish_at < now())
                @include('layout.post-detail')
            @endif
        @endforeach
    </div
</div>
@endsection
