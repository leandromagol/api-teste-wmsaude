<?php

use Illuminate\Database\Seeder;
use App\Clinica;
class clinicaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        
        factory(Clinica::class,30)->create();

    }
}
