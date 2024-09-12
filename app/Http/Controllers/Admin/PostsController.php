<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->pluck('title', 'id');
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        if( $request->hasFile('thumbnail') ) {
            $path = 'thumbnails/' . date( 'Y-m-d' );
            $data[ 'thumbnail' ] = Storage::disk( 'public')
                ->put( $path, $request->file('thumbnail') );
        }

        if( $request->hasFile('poster') ) {
            $path = 'posters/' . date( 'Y-m-d' );
            $data[ 'poster' ] = Storage::disk( 'public')
                            ->put( $path, $request->file('poster') );
        }

        $data[ 'is_published' ] = $request->boolean('is_published');
        $data[ 'user_id' ] = 1;

        Post::create( $data );

        return redirect()->route( 'admin.posts.index' )
            ->with( 'success', trans( 'notifications.post.created' ) );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all()->pluck('title', 'id');
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        if( $request->hasFile('thumbnail') ) {
            if( $post->thumbnail )
                Storage::disk('public')->delete( $post->thumbnail );
            $path = 'thumbnails/' . date( 'Y-m-d' );
            $data[ 'thumbnail' ] = Storage::disk( 'public')
                ->put( $path, $request->file('thumbnail') );
        }

        if( $request->hasFile('poster') ) {
            if( $post->poster )
                Storage::disk('public')->delete( $post->poster );
            $path = 'posters/' . date( 'Y-m-d' );
            $data[ 'poster' ] = Storage::disk( 'public')
                ->put( $path, $request->file('poster') );
        }

        $data[ 'is_published' ] = $request->boolean('is_published');
        $data[ 'user_id' ] = 1;

        $post->update( $data );

        return redirect()->route( 'admin.posts.index' )
            ->with( 'success', trans( 'notifications.post.updated' ) );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if( $post->thumbnail )
            Storage::disk('public')->delete( $post->thumbnail );

        if( $post->poster )
            Storage::disk('public')->delete( $post->poster );

        $post->delete();
        return redirect()->route( 'admin.posts.index' )
            ->with( 'success', trans( 'notifications.post.deleted' ) );
    }
}
