<x-layouts.main title="Create Tag">

    <x-form route="{{ route( 'admin.tags.store' ) }}" method="POST" >
        <div class="mb-3">
            <x-input name="title" label="Title" />
        </div>

        <button class="btn btn-success">Create Tag</button>
    </x-form>

</x-layouts.main>
