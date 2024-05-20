@extends('admin.homepage')
@section('content')
<h4>Received Notification</h4>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Content</th>
      <th scope="col">Read at</th>
      <th scope="col">Created at</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($receivedNotifications as $key=>$notification)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$notification['data']['msg']}}</td>
          <td>{{$notification['read_at']}}</td>
          <td>{{$notification['created_at']}}</td>
        </tr>
      @endforeach  
  </tbody>
</table>
@can('only-admin',Auth::user())
<hr></hr>
<h4>Sent Notification</h4>
<a href="{{route('admin.notification.create')}}">
  <button type="button" class="btn btn-primary">Send a notification</button>
</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Type</th>
      <th scope="col">Receiver</th>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Created at</th>
      <th scope="col">Send date</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($notifications as $key=>$notification)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$notification->type}}</td>
          <td>{{$notification->receiver_id!==null&&$notification->type=='other'?count($notification->receiver_id):$notification->type}}</td>
          <td>{{$notification->title}}</td>
          <td>{{$notification->msg}}</td>
          <td>{{$notification->created_at}}</td>
          <td>{{$notification->send_date}}</td>
          <td>{{$notification->status}}</td>
          <td class="d-flex">
            @if ($notification->status=='pending')
              <a href="{{route('admin.notification.edit',$notification->id)}}">
                <button type="button" class="btn btn-warning">Edit</button>
              </a>
            @endif
            <form method="post" action="{{route('admin.notification.destroy',$notification->id)}}">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach  
  </tbody>
</table>
@endcan

@endsection