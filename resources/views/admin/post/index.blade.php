@extends('admin.homepage')
@section('content')
<div>
    <a href="{{route('admin.post.create')}}">
        <button type="button" class="btn btn-primary">Create</button>
    </a>
</div>
<form action="{{route('admin.post.index')}}" method="get">
  <div class="input-group">
  <input type="text" class="form-control" placeholder="Search" name="search">
    <select class="custom-select" name="category">
      <option value="none">Choose category...</option>
      @foreach ($categories as $category)
      <option value="{{$category->id}}">{{$category->category}}</option>    
      @endforeach
    </select>
    <select class="custom-select" name="status">
      <option value="none">Choose status...</option>
      @foreach ($status as $status)
      <option value="{{$status}}">{{$status}}</option>    
      @endforeach
    </select>
    <div class="input-group-append">
      <button type="submit" class="btn btn-outline-secondary">Search</button>
    </div>
  </div>
</form>
<div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Category</th>
            <th scope="col">Publish date</th>
            <th scope="col">Status</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $posts as $key=>$post )
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->category->category}}</td>
                <td>{{$post->publish_at}}</td>
                <td>{{$post->status}}</td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
                <td class="d-flex">
                  <a href="{{route('admin.post.show',$post->id)}}">
                      <button type="button" class="btn btn-info">Show</button>
                  </a>
                  @if ($post->publish_at>=now())
                  <a href="{{route('admin.post.edit',$post->id)}}">
                      <button type="button" class="btn btn-warning">Edit</button>
                  </a>
                  @endif
                  <form action="{{route('admin.post.destroy',$post->id)}}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" class="deleteBtn btn btn-danger">Delete</button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection