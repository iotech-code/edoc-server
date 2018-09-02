<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Folder::class, function (Faker $faker) {
    return [
        'name' => $faker->numerify("#####"),
        'description' => $faker->text($maxNbChars = 200),
        'school_id' => App\Models\School::inRandomOrder()->first()->id,
        // 'cabinet_id' => App\Models\Cabinet::inRandomOrder()->first()->id,
    ];
});
