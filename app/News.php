<?php

namespace App;

class News extends Model
{

    protected static function boot()
    {
        parent::boot();
        
        static::created(function(){
            \Cache::tags(['news'])->flush();
        });

        static::updated(function(){
            \Cache::tags(['news'])->flush();
        });

        static::deleted(function(){
            \Cache::tags(['news'])->flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
