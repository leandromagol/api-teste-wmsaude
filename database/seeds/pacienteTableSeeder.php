<?php
use App\Paciente;

use Illuminate\Database\Seeder;

class pacienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Paciente::class,30)->create();

    }
}
