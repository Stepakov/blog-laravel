<x-layouts.main title="Categories">
    <a href="{{ route( 'admin.categories.create' ) }}">
        Create Category
    </a>

    <hr>

    @forelse( $categories as $category )
        <div class="my-1">
            {{ $category->title }} -
            <a href="{{ route( 'admin.categories.show', $category->slug ) }}">Show</a>
            |
            <a href="{{ route( 'admin.categories.edit', $category->slug) }}">Edit</a>
            |
            <x-form route="{{ route( 'admin.categories.destroy', $category->slug ) }}" method="DELETE">
                <button class="btn btn-danger btn-sm">Delete</button>
            </x-form>
        </div>
    @empty
        No Categories
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

            if( confirm( 'Are you sure you want to delete Category?' ) )
            {
                event.target.closest( 'form' ).submit();
            }
        })
    })

</script>
