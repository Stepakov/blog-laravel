<?php

namespace App\Models;

use App\Enum\Post\Status;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $casts = [
        'status' => Status::class,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'title',
        'content',
        'thumbnail',
        'poster',
        'user_id',
        'category_id',
        'is_published',
        'status',
    ];

    public function getThumbnail()
    {
        return $this->thumbnail ? asset( 'storage/' . $this->thumbnail ) : asset( 'no-image.png' );
    }

    public function getPostAttribute()
    {
        return $this->poster ? asset( 'storage/' . $this->poster ) : asset( 'no-image.png' );
    }

    public function getAvtorAttribute()
    {
        return $this->user->name;
    }

    public function getCatAttribute()
    {
        return $this->category ? $this->category->title : "No Category";
    }

    public function getTags()
    {
        return $this->tags;
    }

    /* RELATIONSHIPS */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
