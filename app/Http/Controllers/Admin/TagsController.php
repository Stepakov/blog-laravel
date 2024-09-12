<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $data = $request->validated();

        Tag::create( $data );

        return redirect()->route( 'admin.tags.index' )
            ->with( 'success', trans( 'notifications.tag.created' ) );
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $data = $request->validated();

        $tag->update( $data );

        return redirect()->route( 'admin.tags.index' )
            ->with( 'success', trans( 'notifications.tag.updated' ) );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
//        if( $tag->posts->count() )
//        {
//            return redirect()->route( 'admin.tags.index' )
//                ->with( 'success', trans( 'notifications.tag.hasRelations' ) );
//        }
        if( $tag->posts()->exists() )
        {
            $tag->posts()->detach();
        }

        $tag->delete();
        return redirect()->route( 'admin.tags.index' )
            ->with( 'success', trans( 'notifications.tag.deleted' ) );
    }
}
