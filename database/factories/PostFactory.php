<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'content' => $faker->realText($maxNbChars = 200, $indexSize = 1),
        'category_id'=>$faker->numberBetween(1,5),
    ];
});
