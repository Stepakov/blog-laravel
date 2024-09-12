<x-layouts.main :title="$post->title">

    Title: {{ $post->title }} <br>
    Content: {!! $post->content !!} <br>
    Thumbnail: <img src="{{ $post->getThumbnail() }}" alt="{{ $post->title }}" width="75"> <br>
    Image: <img src="{{ $post->post }}" alt="{{ $post->title }}" width="150"> <br>
    User: {{ $post->avtor }} <br>
    Category: {{ $post->cat }} <br>
    Is Published: {{ $post->is_published }} <br>
    Status: {{ $post->status }} <br>

</x-layouts.main>
