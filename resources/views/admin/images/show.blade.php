@extends('admin.homepage')
@section('content')
<div>
    <button onclick="history.back()" class="btn btn-warning">Back</button>
</div>
<div class="d-flex flex-column align-items-center">
    <img src="{{$image->path}}" alt="">
    <p><i>{{$image->original_name}}</i></p>
</div>
@endsection
