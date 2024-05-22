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
                @include('layout.post-detail')
            @endif
        @endforeach
    </div>
</div>
@endsection
