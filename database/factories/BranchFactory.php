<?php
use Faker\Generator as Faker;


$factory->define(App\APIModels\Branch::class, function (Faker $faker) {
 
    return [
        'name' => $faker->name,
        'number' => $faker->tollFreePhoneNumber,
        'street' => $faker->streetName,
        'city' => $faker->city,
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        
        
    ];
});