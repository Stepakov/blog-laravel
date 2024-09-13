<x-layouts.main title="Register">

    <x-form route="{{ route( 'admin.users.registerStore' ) }}" method="POST" enctype="true">

        <div class="mb-3">
            <x-input name="name" label="Name" value="{{ old( 'name') }}"/>
        </div>

        <div class="mb-3">
            <x-input name="email" label="Email" type="email" value="{{ old( 'email') }}"/>
        </div>

        <div class="mb-3">
            <x-input name="avatar" label="Avatar" :value="old( 'avatar' )" type="file" />
        </div>

        <div class="mb-3">
            <x-input name="password" label="Password" type="password" />
        </div>

        <button class="btn btn-success">Register</button>
    </x-form>

</x-layouts.main>
