<?php

use Illuminate\Database\Seeder;

class PostsToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Post::class, 20)->create();
    }
}
