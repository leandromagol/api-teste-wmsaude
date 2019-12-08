<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Clinica;
use Faker\Generator as Faker;

$factory->define(App\Clinica::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'cnes'=>$faker->numberBetween(10000,210000000),
        'proprietario'=>$faker->name,
        'cnpj'=>$faker->numberBetween(10000,210000000),
    ];
});
