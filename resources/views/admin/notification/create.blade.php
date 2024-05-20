
@extends('admin.homepage')
@section('content')
<div>
    <form action="{{route('admin.notification.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Message</label>
            <input type="text" name="msg" class="form-control" id="exampleInputPassword1">
        </div>
        <label for="option">Send notification to:</label>
        <div class="d-flex pb-3" id="option">
            <select id="users" name="type" class="form-select">
                <option id="all" value="all" selected>All user</option>
                <option id="writer" value="writer">Only writter</option>
                <option id="user" value="user">Only user</option>
                <option id="other" value="other">Other</option>
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
            <input name="send_date" type="datetime-local" value="{{date('Y-m-d H:i')}}"/>
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