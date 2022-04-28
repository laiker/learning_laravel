<?php

namespace App;

class Tag extends Model
{
    public function getRouteKeyName()
    {
        return 'name';
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
    
    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }
    
    public static function tagsCloud()
    {
        return (new static())->has('posts')->get();
    }
}
