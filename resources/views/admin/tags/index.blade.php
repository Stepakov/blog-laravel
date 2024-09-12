<x-layouts.main title="Tags">
    <a href="{{ route( 'admin.tags.create' ) }}">
        Create Tag
    </a>

    <hr>

    @forelse( $tags as $tag )
        <div class="my-1">
            {{ $tag->title }} -
            <a href="{{ route( 'admin.tags.show', $tag->slug ) }}">Show</a>
            |
            <a href="{{ route( 'admin.tags.edit', $tag->slug) }}">Edit</a>
            |
            <x-form route="{{ route( 'admin.tags.destroy', $tag->slug ) }}" method="DELETE">
                <button class="btn btn-danger btn-sm">Delete</button>
            </x-form>
        </div>
    @empty
        No Tags
    @endforelse

</x-layouts.main>


<style>
    form {
        display: inline-block;
    }
</style>
<script>
    var btns = document.querySelectorAll( '.btn-danger' );

    btns.forEach( function( btn ) {
        btn.addEventListener( 'click', function( event ){
            event.preventDefault();

            if( confirm( 'Are you sure you want to delete Tag?' ) )
            {
                event.target.closest( 'form' ).submit();
            }
        })
    })

</script>
