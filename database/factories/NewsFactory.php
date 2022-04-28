<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;



$factory->define(News::class, function (Faker $faker) {

    return [
        'code' => $faker->unique()->word,
        'title' => $faker->words(3, true),
        'preview_text' => $faker->sentence,
        'detail_text' => $faker->paragraph(2, true),
        'published' => $faker->numberBetween(0,1),
    ];
});
