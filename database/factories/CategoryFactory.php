<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(array ('Sport','Heath','Music','Policy','Entertainment','Phisique','Economy')),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
