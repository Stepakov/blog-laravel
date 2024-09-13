<x-layouts.main title="Profile">

    <x-form route="{{ route( 'admin.profile.update', $user->id ) }}" method="POST" enctype="true">

        <div class="mb-3">
            <x-input name="name" label="Name" value="{{ old( 'name') ?? $user->name }}"/>
        </div>

        <div class="mb-3">
            <x-input name="email" label="Email" type="email" value="{{ old( 'email') ?? $user->email }}"/>
        </div>

        <div>
            <img src="{{ $user->getAvatar() }}" alt="" width="150">
        </div>
        <div class="mb-3">
            <x-input name="avatar" label="Avatar" :value="old( 'avatar' ) ?? 'avatars/' . $user->avatar" type="file" />
        </div>

        <div class="mb-3">
            <a href="{{ route( 'password.request', [ 'email' => $user->email ]) }}">Send me new Password</a>
        </div>

        <button class="btn btn-success">Update Profile</button>
    </x-form>

</x-layouts.main>
