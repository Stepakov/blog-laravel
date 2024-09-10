<x-layouts.main title="Update Category">

    <x-form route="{{ route( 'admin.categories.update', $category->slug ) }}" method="PUT" >
{{--    <form action="{{ route( 'admin.categories.update', $category->slug ) }}" method="POST">--}}
        <div class="mb-3">
            <x-input name="title" label="Title" value="{{ $category->title }}" />
        </div>

        <button class="btn btn-success">Update Category</button>
{{--    </form>--}}
    </x-form>

</x-layouts.main>
