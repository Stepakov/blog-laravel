<x-layouts.main title="Create Post">

    <x-form route="{{ route( 'admin.posts.store' ) }}" method="POST" enctype="true">
        <div class="mb-3">
            <x-input name="title" label="Title" :value="old( 'title' )" />
        </div>

        <div class="mb-3">
            <x-text name="content" label="Content" :value="old( 'content' )" />
        </div>

        <div class="mb-3">
            <x-input name="thumbnail" label="Thumbnail" :value="old( 'thumbnail' )" type="file" />
        </div>

        <div class="mb-3">
            <x-input name="poster" label="Poster" :value="old( 'poster' )" type="file" />
        </div>

        <div class="mb-3">
            <x-select name="category_id"
                      label="Category"
                      :value="old( 'category_id' )"
                      :options="$categories"
            />
        </div>

        <div class="mb-3">
            <x-select name="tags[]"
                      label="Tags"
                      :value="old( 'tags' )"
                      :options="$tags"
                      :multiple="true"
            />
        </div>

        <div class="mb-3">
            <x-checkbox name="is_published" label="Is Published" :value="old( 'is_published' )"  />
        </div>


        <button class="btn btn-success">Create Post</button>
    </x-form>

</x-layouts.main>
