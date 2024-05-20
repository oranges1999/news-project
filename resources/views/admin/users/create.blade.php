@extends('admin.homepage')
@section('content')
    <form action="{{route('admin.users.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="string" class="form-control" id="exampleInputEmail1" name="name" value="{{old('name')}}">
            @foreach ($errors->get('name') as $nameMessage)
                <div>{{$nameMessage}}</div>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{old('email')}}">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            @foreach ($errors->get('email') as $emailMessage)
                <div>{{$emailMessage}}</div>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            @foreach ($errors->get('password') as $passwordMessage)
                <div>{{$passwordMessage}}</div>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password confirm</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmed">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Role</label>
            <select name="role" class="form-select" aria-label="Default select example">
                <option value="1">Admin</option>
                <option value="2">Writter</option>
                <option value="3" selected>User</option>
            </select>
            @foreach ($errors->get('role') as $roleMessage)
                <div>{{$roleMessage}}</div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('admin.users.index')}}">
            <button type="button" class="btn btn-warning">Cancle</button>
        </a>
    </form>  
@endsection