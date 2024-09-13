<x-layouts.main title="Forgot Password">

    <x-form route="{{ route( 'password.update' ) }}" method="POST">

        <div class="mb-3">
            <x-input name="token" label="Token" type="hidden" value="{{ $token }}"/>
        </div>

        <div class="mb-3">
            <x-input name="email" label="Email" type="email" value="{{ request()->get( 'email' ) }}"/>
        </div>

        <div class="mb-3">
            <x-input name="password" label="Password" type="password" />
        </div>

        <div class="mb-3">
            <x-input name="password_confirmation" label="Password" type="password" />
        </div>



        <button class="btn btn-success">Send me new Password</button>
    </x-form>

</x-layouts.main>
