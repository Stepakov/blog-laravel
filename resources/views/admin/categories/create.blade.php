<x-layouts.main title="Create Category">

    <x-form route="{{ route( 'admin.categories.store' ) }}" method="POST" >
        <div class="mb-3">
            <x-input name="title" label="Title" />
        </div>

        <button class="btn btn-success">Create Category</button>
    </x-form>

</x-layouts.main>
