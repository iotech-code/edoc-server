<?php

use Faker\Generator as Faker;

$factory->define(App\Models\School::class, function (Faker $faker) {
    return [
        'code' => $faker->numerify('##########'),
        'name' => "โรงเรียน ".$faker->word
    ];
});
