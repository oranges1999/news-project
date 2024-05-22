@extends('admin.homepage')
@section('styles')
<style>
    .img{
        max-width: 100%;
    }
    .img-container{
        width: 300px;
    }
    .delete{
        background: none;
        border: none;
    }
</style>
@endsection
@section('content')
<h3>Image</h3>
<hr>
<a href="{{route('admin.image.create')}}">
    <button type="buton" class="btn btn-primary">Add Images</button>
</a>
<div class="d-flex">
    @foreach ($images as $image)
    <div class="d-flex flex-column align-items-center">
        <div class="img-container mx-2 my-2">
            <a href="{{route('admin.image.show',$image->id)}}">
                <img src="{{$image->path}}" alt="" class="img">
                <div style="">{{$image->original_name}}</div>
            </a>
        </div>
        <div>
            <form action="{{route('admin.image.destroy',$image->id)}}" method="post">
                @csrf
                @method('delete')
                <button class="delete" type="submit"><i class="fa-solid fa-x"></i></button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
@section('script')
<script>
$('.delete').click(function(e){
    e.preventDefault()
    if (confirm('Are you sure?')==true) {
        $(e.target).closest('form').submit()
    }
})
</script>
@endsection
