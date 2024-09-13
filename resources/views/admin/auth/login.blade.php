<x-layouts.main title="Login">

    <x-form route="{{ route( 'admin.users.loginStore' ) }}" method="POST" enctype="true">


        <div class="mb-3">
            <x-input name="email" label="Email" type="email" value="{{ old( 'email') }}"/>
        </div>

        <div class="mb-3">
            <x-input name="password" label="Password" type="password" />
        </div>

        <div class="mb-3">
            <x-input name="remember" label="Remember me" type="checkbox" class="form-check-input" />
        </div>

        <button class="btn btn-success">Login</button>
    </x-form>

</x-layouts.main>
