@foreach($posts as $post)
    @include('posts.show',['post'=>$post])
@endforeach