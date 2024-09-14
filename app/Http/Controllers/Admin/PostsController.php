<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd( Post::first()->status->text() );
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->pluck('title', 'id');
        $tags = Tag::all()->pluck('title', 'id');
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

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
        $categories = Category::all()->pluck('title', 'id')->toArray();
        $tags = Tag::all()->pluck('title', 'id')->toArray();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        $this->service->update($data, $post);

        return redirect()->route( 'admin.posts.index' )
            ->with( 'success', trans( 'notifications.post.updated' ) );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->service->delete($post);

        return redirect()->route( 'admin.posts.index' )
            ->with( 'success', trans( 'notifications.post.deleted' ) );
    }
}
