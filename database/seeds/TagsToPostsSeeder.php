<?php

use Illuminate\Database\Seeder;

class TagsToPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $posts = \App\Post::all();
        $maxTags = rand(3, 6);
        $tags = factory(\App\Tag::class, $maxTags)->make();

        /*$posts->each(function(\App\Post $post) use ($tags, $maxTags){
            $random = rand(3,$maxTags);
            $post->tags()->saveMany($tags->random($random));
        });*/
    }
}
