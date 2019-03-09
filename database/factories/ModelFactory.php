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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'mobile_number' => str_random(10),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
// factory(\App\models\lr\LicenseDetailsModel::class,10)->create();170101 171231
$factory->define(\App\models\lr\LicenseDetailsModel::class, function (Faker\Generator $faker) {
    return [
        'operator_user_id' => 89,
        'user_id' => $faker->numberBetween($min = 1, $max = 150),
        'license_type_id' => $faker->numberBetween($min = 1, $max = 25),
        'number' => str_random(10),
        'renewed_date' => $faker->numberBetween($min = 170201, $max = 170228),
        'from_date' => $faker->numberBetween($min = 170201, $max = 170228),
        'to_date' => $faker->numberBetween($min = 170301, $max = 170330),
        'is_active' => 1,
        'is_delete' => 0
    ];
});

