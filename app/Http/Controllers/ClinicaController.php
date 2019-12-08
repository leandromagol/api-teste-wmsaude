<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Clinica as ClinicaResource;
use App\Clinica;

class ClinicaController extends Controller
{
    public function index()
    {
        //
        $clinicas = Clinica::orderBy('nome','asc')->paginate(10);
        return ClinicaResource::collection($clinicas);
    }
    public function listar()
    {
        //
        $clinicas = Clinica::orderBy('nome','asc')->get();
        return ClinicaResource::collection($clinicas);
    }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $clinica = $request->isMethod('put') ? Clinica::findOrFail($request->id) : new Clinica;
        $clinica->id = $request->input('id');
        $clinica->nome = $request->input('nome');
        $clinica->cnes = $request->input('cnes');
        $clinica->proprietario = $request->input('proprietario');
        $clinica->cnpj = $request->input('cnpj');



        if ($clinica->save()) {
            return new ClinicaResource($clinica);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $clinica = Clinica::find($id);
        if (! $clinica) {
            return response()->json(['data'=>['msg'=>'Clinica não encontrado na base de dados']]);
        }else{
            return new ClinicaResource($clinica);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $clinica = Clinica::findOrFail($id);
        if ($clinica->delete()) {
            return new ClinicaResource($clinica);
        }
    }
}
