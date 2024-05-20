@extends('admin.homepage')
@section('content')

<div>
    <div><h4>Notification</h4></div>
</div>

@foreach ($notifications as $notification)
<div class="alert alert-success d-flex justify-content-between" role="alert">
    <div>
        <h5 class="alert-heading">{!!$notification['data']['msg']!!}</h4>    
    </div>
    <div>
        <form action="{{route('admin.adminMarkAsRead')}}" method="post">
            @csrf
            <input type="text" name="id" value="{{$notification['id']}}" hidden>
            <button type="submit" class="btn btn-primary">Mark as read</button>
        </form>
    </div>
</div>
@endforeach
@if (isset($notifications))
  <a href="{{route('admin.adminMarkAllAsRead')}}">
    <button type="button" class="btn btn-primary">Mark all as read</button>
  </a>
@endif
@endsection