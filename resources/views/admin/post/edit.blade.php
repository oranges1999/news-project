@extends('admin.homepage')
@section('styles')
<style>
#showImage{
    max-height: 300px;
}
.image{
    max-height: 200px;
}
#tags{
    width: 100%;
}
</style>
@endsection
@section('content')
<div>
<form action="{{route('admin.post.update',$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title Image</label>
            <select id="titleImage" name="front_page_image_path" aria-label="Default select example">
                <option value="">...</option>
                @foreach ($images as $image)
                <option value="{{$image->path}}" {{$post->front_page_image_path==$image->path?'selected':''}}>
                    {{$image->original_name}}
                </option>
                @endforeach
            </select>
            <div>
                <img id="showImage" src="" alt="">
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="string" class="form-control" name="title" value="{{old('title')?old('title'):$post->title}}">
            @foreach ($errors->get('title') as $titleMessage)
                <div class="text-danger">{{$titleMessage}}</div>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Category</label>
            <select name="category_id" class="form-select" aria-label="Default select example">
                <option value="">...</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">  {{--{{$post->category_id==category->id?"selected":""}} make Undefined constant "category"?--}}
                        {{$category->category}}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Image</label>
            <i>(Copy the image and paste in the content)</i>
            <div>
            @foreach ($images as $image)
                <img src="{{$image->path}}" class="image" alt="">
            @endforeach
            </div>
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Content</label>
            <textarea name="content" id="content">{{old('content')?old('content'):$post->content}}</textarea>
            @foreach ($errors->get('content') as $contentMessage)
                <div>{{$contentMessage}}</div>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tag</label>
            <div>
                <strong><i>Choose tags</i></strong>
                <select id="tags" name="tags[]" class="form-select" aria-label="Default select example"></select>
                @error('tag')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <i>or</i>
            <div>
                <strong><i>Create tags</i></strong>
                <div class="text-align-center input-group mb-3">
                    <input id="createTags" type="text" name="name" placeholder="Tags..." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="createBtn">Create</button>  
                </div>
            </div>
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Publish at</label>
            <input name="publish_at" type="datetime-local" value="{{$post->publish_at}}"/>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('admin.post.index')}}">
            <button type="button" class="btn btn-warning">Cancle</button>
        </a>
</form>
</div>
@endsection
@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    $(document).ready(function(){
        fetchTags();
        ClassicEditor
            .create( document.querySelector( '#content' ),
            {
                ckfinder:
                {
                    uploadUrl:"",
                }
            })
            .catch( error => {
                console.error( error );
            } );
        $('#tags').select2({
            multiple:true,
        });    
    })

    

    function removeTags(){
        $("#tags").empty();
    }

    function fetchTags(){
        fetch('{{route('showTags')}}')
        .then(r=>r.json())
        .then(dat=>$.each(dat,function(index,value){
            var option = '<option value="'+value['id']+'">'+value['name']+'</option>'
            $('#tags').append(option);
        }));
    }
    

    $('#titleImage').on('change', function() {
        $('#showImage').attr('src',this.value)
    });
    
    $('#createBtn').click(function(){
        removeTags();
        fetch('{{route('createTags')}}', {
            method: "POST",
            body: JSON.stringify({
                _token: '{{csrf_token()}}',
                name: $('#createTags').val(),
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });
        fetchTags();
    })

</script>
@endsection
