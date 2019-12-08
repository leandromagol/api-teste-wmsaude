<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pacientes', function () {
    return view('paciente');
});
Route::get('/medicos', function () {
    return view('medicos');
});
Route::get('/clinicas', function () {
    return view('clinicas');
});
Route::get('/consultas', function () {
    return view('consultas');
});

