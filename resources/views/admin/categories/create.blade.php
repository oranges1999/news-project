@extends('admin.homepage')
@section('content')
<div>
    <form action="{{route('admin.categories.store')}}" method="post">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
            </div>
            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="category" value="{{old('category')}}">
        </div>
        @foreach ($errors->get('category') as $categoryMessage)
                <div>{{$categoryMessage}}</div>
        @endforeach
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
            </div>
            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="description" value="{{old('description')}}">
        </div>
        @foreach ($errors->get('description') as $descriptionMessage)
                <div>{{$descriptionMessage}}</div>
        @endforeach        
        <button type="submit" class="btn btn-primary">Create</button>        
    </form>
</div>
@endsection