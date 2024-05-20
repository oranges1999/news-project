@extends('admin.homepage')
@section('content')
<div>
    <a href="{{route('admin.users.create')}}">
        <button type="button" class="btn btn-primary">Create</button>
    </a>
</div>
<div>
<table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Deleted</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $key=>$user )
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <td>{{$user->deleted_at?'Deleted':''}}</td>
                <td class="d-flex">
                    <a href="{{route('admin.users.edit',$user->id)}}">
                        <button type="button" class="btn btn-warning">Edit</button>
                    </a>
                    <form action="{{route('admin.users.destroy',$user->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button onclick="" type="submit" class="deleteBtn btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('script')
<script>
$('#deleteBtn').click(function(e){
    e.preventDefault()
    if (confirm('Are you sure?')) {
        $(e.target).closest('form').submit()    
    }
})
</script>    
@endsection