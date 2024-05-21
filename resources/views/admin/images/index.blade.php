@extends('admin.homepage')
@section('styles')
<style>
    .img{
        max-width: 100%;
    }
    .img-container{
        height: 350px;
        width: 300px;
    }
</style>
@endsection
@section('content')
<h3>Image</h3>
<hr>
<a href="{{route('admin.image.create')}}">
    <button type="buton" class="btn btn-primary">Add Images</button>
</a>
<div class="d-flex">
    @foreach ($images as $image)

        <div class="img-container px-4 py-3">
            <div class="text-wrap">{{$image->original_name}}</div>
            <img src="{{$image->path}}" alt="" class="img">
        </div>
    @endforeach
</div>
@endsection
