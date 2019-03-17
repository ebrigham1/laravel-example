<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Location::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->regexify('[A-Z][A-Z]-[0-9][0-9]-[A-Z][0-9]'),
    ];
});
