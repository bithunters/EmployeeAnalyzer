<?php

use App\APIModels\Employee;;
use App\APIModels\Branch;
use Faker\Generator as Faker;


$factory->define(App\APIModels\Department::class, function (Faker $faker) {
 
    return [
        'name' => $faker->name,
        'manager_id' => function(){
            return Employee::all()->random();
        },
        'manager_start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        
        'branch_id' => function(){
            return Branch::all()->random();
        },
        
        
    ];
});