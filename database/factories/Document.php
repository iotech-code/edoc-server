<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Document::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber($nbDigits = NULL, $strict = false) ,
        'from' => $faker->name,
        'title' => $faker->word,
        'receive_code' => $faker->randomNumber($nbDigits = NULL, $strict = false) ,
        'receive_date' => $faker->date($format = 'Y-m-d', $max = '+30 days') ,
        'receive_achives' => $faker->name ,
        'date' => $faker->date($format = 'Y-m-d', $max = '+30 days') ,
        'refer' => $faker->name ,
        'keywords' => $faker->words($nb = 3, $asText = false) ,
        'status' => mt_rand(1,4) ,
        'cabinet_id' => App\Models\Cabinet::inRandomOrder()->first()->id

    ];
});

$factory->define(App\Models\DocumentAttachment::class, function (Faker $faker) {
    return [
        
    ];
});

$factory->define(App\Models\Cabinet::class, function (Faker $faker) {
    return [
        
    ];
});
