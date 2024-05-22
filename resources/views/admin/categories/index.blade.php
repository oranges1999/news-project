@extends('admin.homepage')
@section('content')
<h3>Category</h3>
<hr>
<div>
    <a href="{{route('admin.categories.create')}}">
        <button type="button" class="btn btn-primary">Create</button>
    </a>
</div>
<div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $categories as $key=>$category )
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$category->category}}</td>
                <td>{{$category->description}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->updated_at}}</td>
                <td class="d-flex">
                    <a href="{{route('admin.categories.edit',$category->id)}}">
                        <button type="button" class="btn btn-warning">Edit</button>
                    </a>
                    <form action="{{route('admin.categories.destroy',$category->id)}}" method="POST">
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
$('.deleteBtn').click(function(e){
    e.preventDefault()
    if (confirm('Are you sure?')==true) {
        $(e.target).closest('form').submit()
    }
})
</script>

@endsection
