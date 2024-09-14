<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store( array $data ) : void
    {
        $tags = Arr::pull( $data, 'tags' );

        $data[ 'thumbnail' ] = $this->addImage(
            $data[ 'thumbnail' ] ?? null,
            'thumbnails'
        );

        $data[ 'poster' ] = $this->addImage(
            $data[ 'poster' ] ?? null,
            'posters'
        );

//        if( !empty( $data[ 'thumbnail' ] ) ) {
//            $path = 'thumbnails/' . date( 'Y-m-d' );
//            $data[ 'thumbnail' ] = Storage::disk( 'public')
//                ->put( $path, $data[ 'thumbnail' ] );
//        }
//
//        if( !empty( $data[ 'poster' ]) ) {
//            $path = 'posters/' . date( 'Y-m-d' );
//            $data[ 'poster' ] = Storage::disk( 'public')
//                ->put( $path, $data[ 'poster' ] );
//        }

        $data[ 'is_published' ] = isset( $data[ 'is_published' ] ) ? true : false;
        $data[ 'user_id' ] = 1;

        $post = Post::create( $data );

        $post->tags()->attach( $tags );
    }

    public function update(array $data, Post $post) : void
    {
        $tags = Arr::pull( $data, 'tags' );

        $data[ 'thumbnail' ] = $this->addImage(
            $data[ 'thumbnail' ] ?? null,
            'thumbnails',
            $post->thumbnail
        );

        $data[ 'poster' ] = $this->addImage(
            $data[ 'poster' ] ?? null,
            'posters',
            $post->poster
        );

//        if( !empty( $data[ 'thumbnail' ] ) ) {
//            $this->deleteImage( $post->thumbnail );
//            $path = 'thumbnails/' . date( 'Y-m-d' );
//            $data[ 'thumbnail' ] = Storage::disk( 'public')
//                ->put( $path, $data[ 'thumbnail' ] );
//        }
//
//        if( !empty( $data[ 'poster' ]) ) {
//            $this->deleteImage( $post->poster );
//
//            $path = 'posters/' . date( 'Y-m-d' );
//            $data[ 'poster' ] = Storage::disk( 'public')
//                ->put( $path, $data[ 'poster' ] );
//        }

        $data[ 'is_published' ] = isset( $data[ 'is_published' ] ) ? true : false;

        $post->update( $data );

        $post->tags()->sync( $tags );
    }

    public function delete( Post $post ) : void
    {
        $this->deleteImage( $post->thumbnail );

        $this->deleteImage( $post->poster );

        $post->tags()->detach();

        $post->delete();
    }


    protected function deleteImage( string $path ) : bool
    {
        if( $path )
            return Storage::disk('public')->delete( $path );
        return false;
    }

    protected function addImage( ?UploadedFile $file, string $imagePath = 'images', ?string $path = null ) : ?string
    {
        if( $file && $file->isValid() ) {
            if( $path )
                $this->deleteImage( $path );
            $path = $imagePath . '/' . date( 'Y-m-d' );
            return Storage::disk( 'public')
                ->put( $path, $file );
        }

        return null;
    }
}
