<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Stat::class, function (Faker\Generator $faker) {

    return [
        'household_id' => $faker->numberBetween(9,1000),
        'household_count' => $faker->numberBetween(1,10),

    ];
});
$factory->define(App\Household::class, function (Faker\Generator $faker) {
    //static $password;

    return [
        'number'=>$faker->numberBetween(70,30000),
        'name'=>$faker->name,
        'gender'=>'Male',
        'age'=>$faker->numberBetween(20,80),
        'civilstatus'=>'Married',
        'wife'=>FALSE,
        'children'=>FALSE,
        'linked'=>FALSE,
        'extended_id'=>1,
        'nationality'=>'Gypsy',
        'fiscal'=>'Tax payer',
        'socialclass_id'=>$faker->numberBetween(1,2),
        'skill_id'=>$faker->numberBetween(1,17),
        'land'=>$faker->numberBetween(0,5000),
        'crops'=>'None',
        'illness'=>'None',
        'servant'=>'No',
        'horses'=>$faker->numberBetween(0,10),
        'bulls'=>$faker->numberBetween(0,10),
        'cows'=>$faker->numberBetween(0,10),
        'sheep'=>$faker->numberBetween(0,10),
        'goats'=>$faker->numberBetween(0,10),
        'pigs'=>$faker->numberBetween(0,10),
        'buffalos'=>$faker->numberBetween(0,10),
        'donkeys'=>$faker->numberBetween(0,10),
        'mules'=>$faker->numberBetween(0,10),
        'hives'=>$faker->numberBetween(0,10),
        'plumtrees'=>$faker->numberBetween(0,10),
        'mulberrytrees'=>$faker->numberBetween(0,10),
        'vineyards'=>$faker->numberBetween(0,10),
        'fruittrees'=>$faker->numberBetween(0,10),
        //'village_id'=>$faker->numberBetween(1,3),
        'village_id'=>1,
        'source_id'=>1,
    ];
});
