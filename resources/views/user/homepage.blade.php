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
        @include('layout.post-detail')
    @endforeach
</div>
@endsection

