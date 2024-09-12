<x-layouts.main title="Update Tag">

    <x-form route="{{ route( 'admin.tags.update', $tag->slug ) }}" method="PUT" >
        <div class="mb-3">
            <x-input name="title" label="Title" value="{{ $tag->title }}" />
        </div>

        <button class="btn btn-success">Update Tag</button>
    </x-form>

</x-layouts.main>
