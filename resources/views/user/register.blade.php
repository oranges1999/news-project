@extends('layout.main')
@section('content')
<form action="{{route('pRegister')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name" value="{{old('name')}}">
        @if ($errors->has('name'))
            @foreach ($errors->get('name') as $nameMessage)
                    <div>{{$nameMessage}}</div>
            @endforeach    
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{old('email')}}">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        @if ($errors->has('email'))
            @foreach ($errors->get('email') as $emailMessage)
                    <div>{{$emailMessage}}</div>
            @endforeach    
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        @if ($errors->has('password'))
            @foreach ($errors->get('password') as $passwordMessage)
                    <div>{{$passwordMessage}}</div>
            @endforeach
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password confirm</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password_confirmation">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="javascript:history.back()">
        <button type="button" class="btn btn-warning">Back</button>
    </a>
</form>
@endsection
