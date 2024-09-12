<x-layouts.main title="Edit Post">

    <x-form route="{{ route( 'admin.posts.update', $post->slug ) }}" method="PUT" enctype="true">
        <div class="mb-3">
            <x-input name="title" label="Title" :value="old( 'title' ) ?? $post->title" />
        </div>

        <div class="mb-3">
            <x-text name="content" label="Content" :value="old( 'content' ) ?? $post->content" />
        </div>

        <div>
            <img src="{{ $post->getThumbnail() }}" alt="" width="75">
        </div>
        <div class="mb-3">
            <x-input name="thumbnail" label="Thumbnail" :value="old( 'thumbnail' ) ?? $post->thumbnail" type="file" />
        </div>

        <div>
            <img src="{{ $post->post }}" alt="" width="150">
        </div>
        <div class="mb-3">
            <x-input name="poster" label="Poster" :value="old( 'poster' ) ?? $post->poster" type="file" />
        </div>

        <div class="mb-3">
            <x-select name="category_id"
                      label="Category"
                      :value="old( 'category_id' ) ?? $post->category_id"
                      :options="$categories"
            />
        </div>



        <div class="mb-3">
            <x-select name="tags[]"
                      label="Tags"
                      :value="old( 'tags' ) ?? $post->tags->pluck( 'id' )->toArray()"
                      :options="$tags"
                      :multiple="true"
            />
        </div>

        <div class="mb-3">
            <x-checkbox name="is_published" label="Is Published" :value="old( 'is_published' ) ?? $post->is_published"  />
        </div>


        <button class="btn btn-success">Edit Post</button>
    </x-form>

</x-layouts.main>
