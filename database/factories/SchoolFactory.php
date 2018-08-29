<?php

use Faker\Generator as Faker;

$factory->define(App\Models\School::class, function (Faker $faker) {
    return [
        'name' => "โรงเรียน ".$faker->word
    ];
});
