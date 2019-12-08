<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('paciente')->group(function(){
    Route::get('/','PacienteController@Index');
    Route::get('/{id}','PacienteController@Show');
    Route::post('/','PacienteController@store');
    Route::put('/','PacienteController@store');
    Route::delete('/{id}','PacienteController@destroy');

});
 
Route::prefix('medico')->group(function(){
    Route::get('/','MedicoController@Index');
    Route::get('/{id}','MedicoController@Show');
    Route::post('/','MedicoController@store');
    Route::put('/','MedicoController@store');
    Route::delete('/{id}','MedicoController@destroy');

});
Route::prefix('clinica')->group(function(){
    Route::get('/','ClinicaController@Index');
    Route::get('/{id}','ClinicaController@Show');
    Route::post('/','ClinicaController@store');
    Route::put('/','ClinicaController@store');
    Route::delete('/{id}','ClinicasController@destroy');

});

Route::prefix('consulta')->group(function(){
    Route::get('/','ConsultaController@Index');
    Route::get('/{id}','ConsultaController@Show');
    Route::post('/','ConsultaController@store');
    Route::put('/','ConsultaController@store');
    Route::delete('/{id}','ConsultaController@destroy');

});

Route::get('listarclinicas','ClinicaController@Listar');
Route::get('listarmedicos','MedicoController@Listar');
Route::get('listarpacientes','PacienteController@Listar');
