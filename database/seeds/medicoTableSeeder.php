<?php

use Illuminate\Database\Seeder;
use App\Medico;
class medicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Medico::class,30)->create();

    }
}
