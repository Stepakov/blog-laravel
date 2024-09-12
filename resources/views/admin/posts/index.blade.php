<x-layouts.main title="Posts">
    <a href="{{ route( 'admin.posts.create' ) }}">
        Create Post
    </a>

    <hr>

    @forelse( $posts as $post )
        <div class="my-1">
            {{ $post->id }}|{{ $post->title }} -
            <a href="{{ route( 'admin.posts.show', $post->slug ) }}">Show</a>
            |
            <a href="{{ route( 'admin.posts.edit', $post->slug) }}">Edit</a>
            |
            <x-form route="{{ route( 'admin.posts.destroy', $post->slug ) }}" method="DELETE">
                <button class="btn btn-danger btn-sm">Delete</button>
            </x-form>
        </div>
    @empty
        No Posts
    @endforelse

</x-layouts.main>


<style>
    form {
        display: inline-block;
    }
</style>
<script>
    var btns = document.querySelectorAll('.btn-danger');

    btns.forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            event.preventDefault();

            if (confirm('Are you sure you want to delete Post?')) {
                event.target.closest('form').submit();
            }
        })
    })

</script>
