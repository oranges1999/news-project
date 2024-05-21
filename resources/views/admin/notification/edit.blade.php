@extends('admin.homepage')
@section('content')
<h3>Notification</h3>
<hr>
<div>
    <form action="{{route('admin.notification.update',$notification->id)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$notification->title}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Message</label>
            <input type="text" name="msg" class="form-control" id="exampleInputPassword1" value="{{$notification->msg}}">
        </div>
        <label for="option">Send notification to:</label>
        <div class="d-flex pb-3" id="option">
            <select id="users" name="type" class="form-select">
                <option id="all" value="all" {{$notification->type=='all'?'selected':''}}>All user</option>
                <option id="writer" value="writer" {{$notification->type=='writer'?'selected':''}}>Only writter</option>
                <option id="user" value="user" {{$notification->type=='user'?'selected':''}}>Only user</option>
                <option id="other" value="other" {{$notification->type=='other'?'selected':''}}>Other</option>
            </select>
            <br>
            <select id="select-user" name="receiver_id[]" class="form-select w-50" disabled>
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Send date</label>
            <input name="send_date" type="datetime-local" value="{{$notification->send_date}}"/>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    $("#users").change(function(){
        if($("#other:selected").length>0){
            $('#select-user').removeAttr('disabled')
        }
        if($("#all:selected").length>0){
            $('#select-user').attr('disabled','disabled')
        }
        if($("#writer:selected").length>0){
            $('#select-user').attr('disabled','disabled')
        }
        if($("#user:selected").length>0){
            $('#select-user').attr('disabled','disabled')
        }
    })
})
$('#select-user').select2({
    multiple:true,
});
</script>
@endsection
