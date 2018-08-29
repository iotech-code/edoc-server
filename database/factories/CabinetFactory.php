<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Cabinet::class, function (Faker $faker) {
    return [
        'name' => "ตู้ทดสอบ ".$faker->word,
        "school_id"=> 1,
        "description" => $faker->text
    ];
});
