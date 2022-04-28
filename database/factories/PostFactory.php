<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;



$factory->define(Post::class, function (Faker $faker) {
    
    $users = \App\User::all()->pluck('id')->toArray();

    return [
        'code' => $faker->unique()->word,
        'title' => $faker->words(3, true),
        'preview_text' => $faker->sentence,
        'detail_text' => $faker->paragraph(2, true),
        'published' => $faker->numberBetween(0,1),
        'owner_id' => $users[rand(0,count($users)-1)],
    ];
});
