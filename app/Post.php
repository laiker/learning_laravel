<?php

namespace App;
use Illuminate\Support\Arr;

class Post extends Model
{
    protected $dispatchesEvents = [
        'updated' => \App\Events\PostUpdated::class
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($post){
            $after = $post->getDirty();
            $post->history()->attach(auth()->id(), [
                'before' => json_encode(Arr::only($post->fresh()->toArray(), array_keys($after))),
                'after' => json_encode($after)
            ]);
        });

        static::created(function(){
            \Cache::tags(['posts'])->flush();
        });

        static::updated(function(){
            \Cache::tags(['posts'])->flush();
        });

        static::deleted(function(){
            \Cache::tags(['posts'])->flush();
        });

    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    public function history()
    {
        return $this->belongsToMany(\App\User::class, 'post_histories')
                ->withPivot(['before', 'after'])->withTimeStamps();
    }

    
}
