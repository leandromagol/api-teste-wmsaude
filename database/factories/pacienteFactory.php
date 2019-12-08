<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Paciente;
use Faker\Generator as Faker;

$factory->define(App\Paciente::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'sexo'=>$faker->randomElements(['masculino' ,'feminino']),
        'idade'=>$faker->numberBetween(1,110),
        'email' => $faker->unique()->safeEmail,
    ];
});
