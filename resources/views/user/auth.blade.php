@extends('layout.main')
@section('content')
    <form action="{{route('pLogin')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{old('email')}}">
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
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('homepage')}}">
            <button type="button" class="btn btn-warning">Back to Homepage</button>
        </a>
        <a href="{{route('register')}}">
            <button type="button" class="btn btn-info">Register</button>
        </a>
        @if ($errors->has('msg'))
            <div>{{$errors->first('msg')}}</div>
        @endif
    </form>
@endsection
