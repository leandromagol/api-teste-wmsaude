<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Medico;
use Faker\Generator as Faker;

$factory->define(Medico::class, function (Faker $faker) {
    return [
        //
        'nome'=>$faker->name,
        'crm'=>$faker ->numberBetween(1000,21000000),
        'email'=>$faker->email,
        'especialidade'=>$faker->randomElement(['Cardiologista' ,'Clinico geral', 'Dentista'])
    ];
});
