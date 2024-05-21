@extends('admin.homepage')
@section('content')
<h3>User</h3>
<hr>
<div>
    <h4>Information</h4>
    <a>
        <button type="button" onclick="history.back()" class="btn btn-warning">Cancle</button>
    </a>
    <form action="{{route('admin.users.update',$user->id)}}" method="post">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="string" class="form-control" id="exampleInputEmail1" name="name" value="{{old('name')?old('name'):$user->name}}">
            @foreach ($errors->get('name') as $nameMessage)
                <div>{{$nameMessage}}</div>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input disabled type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" name="email" value="{{$user->email}}">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            @foreach ($errors->get('email') as $emailMessage)
                <div>{{$emailMessage}}</div>
            @endforeach
        </div>
        @can('only-admin',Auth::id())
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Role</label>
            <select name="role" class="form-select" aria-label="Default select example">
                <option value="1" {{$user->role==1?'selected':''}}>Admin</option>
                <option value="2" {{$user->role==2?'selected':''}}>Writter</option>
                <option value="3" {{$user->role==3?'selected':''}}>User</option>
            </select>
            @foreach ($errors->get('role') as $roleMessage)
                <div>{{$roleMessage}}</div>
            @endforeach
        </div>
        @endcan
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<hr></hr>
<div>
    <h4>Change Password</h4>
    <form action="{{route('admin.users.update',$user->id)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="exampleInputPassword1">Old Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Old Password" name="old_password">
            @foreach ($errors->get('old_password') as $oldPasswordMessage)
                <div>{{$oldPasswordMessage}}</div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">New Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="New Password" name="password">
            @foreach ($errors->get('password') as $passwordMessage)
                <div>{{$passwordMessage}}</div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">New Password Confirmation</label>
            <input type="password" class="form-control" id="exampleInputPassword3" placeholder="New Password Confirm" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Change</button>
    </form>
</div>
@endsection
