<?php

namespace App\Http\Controllers;
use App\Paciente;
use Illuminate\Http\Request;
use App\Http\Resources\Paciente as PacienteResource;

class PacienteController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pacientes = Paciente::orderBy('nome','asc')->paginate(10);
        return PacienteResource::collection($pacientes);
    }
    public function listar()
    {
        //
        $pacientes = Paciente::orderBy('nome','asc')->get();
        return PacienteResource::collection($pacientes);
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
        $paciente = $request->isMethod('put') ? Paciente::findOrFail($request->id) : new Paciente;
        $paciente->id = $request->input('id');
        $paciente->nome = $request->input('nome');
        $paciente->sexo = $request->input('sexo');
        $paciente->idade = $request->input('idade');
        $paciente->email = $request->input('email');



        if ($paciente->save()) {
            return new PacienteResource($paciente);
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
        
        $paciente = Paciente::find($id);
        if (! $paciente) {
            return response()->json(['data'=>['msg'=>'Paciente não encontrado na base de dados']]);
        }else{
            return new PacienteResource($paciente);
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
        $paciente = Paciente::findOrFail($id);
        if ($paciente->delete()) {
            return new PacienteResource($paciente);
        }
    }
}
