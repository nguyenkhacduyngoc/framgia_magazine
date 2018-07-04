<?php

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'category_id' => $faker->numberBetween($min = 28, $max = 34),
        'title' => $faker->text,
        'subtitle' => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'content' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'status' => $faker->numberBetween($min = 0, $max = 2),
        'count_viewed' => 0,
        'avg_rate' => 0,
    ];
});

