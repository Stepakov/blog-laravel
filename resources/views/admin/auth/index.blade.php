<x-layouts.main title="Users">
    <a href="{{ route( 'admin.users.register' ) }}">
        Registration
    </a>
     |
    <a href="{{ route( 'admin.users.login' ) }}">
        Login
    </a>

    <hr>

    @forelse( $users as $user )
        <div class="my-1">
            {{ $user->id }} |
            {{ $user->name }} -
            {{ $user->email }} -
{{--            <a href="{{ route( 'admin.users.show', $user->slug ) }}">Show</a>--}}
{{--            |--}}
{{--            <a href="{{ route( 'admin.users.edit', $user->slug) }}">Edit</a>--}}
{{--            |--}}
{{--            <x-form route="{{ route( 'admin.users.destroy', $user->slug ) }}" method="DELETE">--}}
{{--                <button class="btn btn-danger btn-sm">Delete</button>--}}
{{--            </x-form>--}}
        </div>
    @empty
        No Users
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

            if( confirm( 'Are you sure you want to delete User?' ) )
            {
                event.target.closest( 'form' ).submit();
            }
        })
    })

</script>
