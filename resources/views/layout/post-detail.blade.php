<a href="{{route('showPost',$post->id)}}">
    <div class="post px-4 py-3">
        <img class="title-image" src="{{$post->front_page_image_path}}" alt="">
        <div class="d-flex justify-content-between">
            <div>
                <div>{{$post->title}}</div>
                <div><p class="">Author: <i>{{$post->user->name}}</i></p></div>
                <div><p>Category: <i>{{$post->category->category}}</i></p></div>
            </div>
            <div class="d-flex flex-column justify-content-end">
                <div><i class="fs-5 fa-regular fa-comment"></i>{{$post->comments()->count()}}</div>
                <div><i class="fs-5 fa-regular fa-heart"></i>{{$post->likePost()->count()}}</div>
            </div>
        </div>
    </div>
</a>
