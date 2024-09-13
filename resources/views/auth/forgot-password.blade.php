<x-layouts.main title="Forgot Password">

    <x-form route="{{ route( 'password.email' ) }}" method="POST">

        <div class="mb-3">
            <x-input name="email" label="Email" type="email" value="{{ request()->get( 'email' ) }}"/>
        </div>

        <button class="btn btn-success">Send me new Password</button>
    </x-form>

</x-layouts.main>
