@extends('admin.homepage')
@section('content')
<form action="{{route('admin.comment.index')}}" method="get">
  <div class="input-group">
  <input type="text" class="form-control" placeholder="Search" name="search">
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
            <th scope="col">User</th>
            <th scope="col">Post</th>
            <th scope="col">Content</th>
            @can('only-admin',Auth::id())
            <th scope="col">Status</th>
            <th scope="col">Deleted at</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Action</th>
            @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ( $comments as $key=>$comment )
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$comment->users->name}}</td>
                <td>{{$comment->posts->title}}</td>
                <td>{{$comment->content}}</td>
                <td>{{$comment->status}}</td>
                <td>{{$comment->deleted_at}}</td>
                <td>{{$comment->created_at}}</td>
                <td>{{$comment->updated_at}}</td>
                @can('only-admin',Auth::id())
                <td class="d-flex">
                    @if ($comment->status == 'Pending')
                    <a href="{{route('admin.comment.edit',$comment->id)}}">
                        <button type="button" class="btn btn-primary">Publish</button>
                    </a>
                    @endif
                    <form method="post" action="{{route('admin.comment.destroy',$comment->id)}}">
                        @csrf
                        @method('destroy')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection