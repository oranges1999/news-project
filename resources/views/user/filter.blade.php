@extends('layout.main')
@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.css" integrity="sha512-PO7TIdn2hPTkZ6DSc5eN2DyMpTn/ZixXUQMDLUx+O5d7zGy0h1Th5jgYt84DXvMRhF3N0Ucfd7snCyzlJbAHQA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>    
<style>
#tags, #search, #category, #author{
    width: 100%;
}    
.title-image{
    width: 300px;
    max-height: 100%;
}
p{
    margin: 0px !important;
}
a{
    text-decoration: none !important;
    color: black !important;
}
</style>
@endsection
@section('content')
<div class="d-flex justify-content-center">
    <h3>Filtering</h3>
</div>
<div class="container d-flex">
    <div class="col-md-1">
        <form action="{{route('postFilter')}}" method="get" enctype="multipart/form-data">
            <div>
                <h5>Categories</h5>
                <select name="category" id="category">
                    <option value=""></option>    
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                    @endforeach
                </select>
            </div>
            <h5>Author</h5>
                <select name="author" id="author">
                    <option value=""></option>
                    @foreach ($authors as $author)
                    <option value="{{$author->id}}">{{$author->name}}</option>
                    @endforeach
                </select>
            <div>
                <h5>Search</h5>
                <input type="text" name="search" id="search">
            </div>
            <div>
                <h5>Tags</h5>
                <select name="tags[]" id="tags"></select>
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
    <div class="col-md-11 d-flex flex-wrap justify-content-center">
        <div class="d-flex flex-wrap justify-content-around">
        @foreach ($posts as $post)
        <a href="{{route('showPost',$post->id)}}">
            <div class="post px-4 py-3">
                <img class="title-image" src="{{$post->front_page_image_path}}" alt="">
                <div>{{$post->title}}</div>
                <div><p class="">Author: <i>{{$post->user->name}}</i></p></div>
                <div><p>Category: <i>{{$post->category->category}}</i></p></div>
            </div>
        </a>
        @endforeach
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js" integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function(){
    fetchTags();
    $('#tags').select2({
        multiple:true,
    });    
})

function fetchTags(){
        fetch('{{route('showTags')}}')
        .then(r=>r.json())
        .then(dat=>$.each(dat,function(index,value){
            var option = '<option value="'+value['id']+'">'+value['name']+'</option>'
            $('#tags').append(option);
        }));
    }
</script>
@endsection