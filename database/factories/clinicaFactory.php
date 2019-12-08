<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Clinica;
use Faker\Generator as Faker;

$factory->define(Clinica::class, function (Faker $faker) {
    return [
        //
        'nome'=>$faker->name,
        'cnes'=>$faker ->numberBetween(1000,21000000),
        'proprietario'=>$faker->name,
        'cnpj'=>$faker->numberBetween(1000,21000000)

        

    ];
});
