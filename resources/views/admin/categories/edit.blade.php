@extends('admin.homepage')
@section('content')
<div>
    <form action="{{route('admin.categories.update',$category->id)}}" method="post">
        @csrf
        @method('put')
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
            </div>
            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="category" value="{{old('category')?old('category'):$category->category}}">
        </div>
        @foreach ($errors->get('category') as $categoryMessage)
                <div>{{$categoryMessage}}</div>
        @endforeach
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
            </div>
            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="description" value="{{old('description')?old('description'):$category->description}}">
        </div>
        @foreach ($errors->get('description') as $descriptionMessage)
                <div>{{$descriptionMessage}}</div>
        @endforeach
        <input type="text" name="id" value="{{$category->id}}" hidden>        
        <a href="{{route('admin.categories.index')}}">
            <button type="button" class="btn btn-danger">Cancel</button>
        </a>
        <button type="submit" class="btn btn-warning">Update</button>        
    </form>
</div>
@endsection