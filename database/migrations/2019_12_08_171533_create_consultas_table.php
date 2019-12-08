<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_medico')->unsigned();
            $table->bigInteger('id_paciente')->unsigned();
            $table->bigInteger('id_clinica')->unsigned();

           
            $table->date('data_consulta');
            $table->enum('status',['Realizado','Cancelado','Aguardando']);
            $table->timestamps();
            $table->foreign('id_medico')->references('id')->on('medico');
            $table->foreign('id_paciente')->references('id')->on('paciente');
            $table->foreign('id_clinica')->references('id')->on('clinicas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
