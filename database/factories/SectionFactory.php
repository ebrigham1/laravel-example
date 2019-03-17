<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Section::class, function (Faker $faker) {
    return [
        'name' => strtoupper($faker->unique()->numerify($faker->unique()->randomLetter . '#')),
    ];
});
