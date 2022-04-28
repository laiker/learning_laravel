<?php

namespace App;

class PostHistory extends Model
{
    public function user()
    {
        return $this->belogsTo(\App\User::class);
    }
    
    public function post()
    {
        return $this->belogsTo(\App\Post::class);
    }
}
