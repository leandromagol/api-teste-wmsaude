<?php

namespace App\Http\Controllers;
use App\Medico;

use Illuminate\Http\Request;
use App\Http\Resources\Medico as MedicoResource;

class MedicoController extends Controller
{
    public function index()
    {
        //
        $medicos = Medico::orderBy('nome','asc')->paginate(10);
        return MedicoResource::collection($medicos);
    }
    public function listar()
    {
        //
        $medicos = Medico::orderBy('nome','asc')->get();
        return MedicoResource::collection($medicos);
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
        $medico = $request->isMethod('put') ? Medico::findOrFail($request->id) : new Medico;
        $medico->id = $request->input('id');
        $medico->nome = $request->input('nome');
        $medico->crm = $request->input('crm');
        $medico->email = $request->input('email');
        $medico->especialidade = $request->input('especialidade');



        if ($medico->save()) {
            return new MedicoResource($medico);
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
        
        $medico = Medico::find($id);
        if (! $medico) {
            return response()->json(['data'=>['msg'=>'Medico não encontrado na base de dados']]);
        }else{
            return new MedicoResource($medico);
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
        $medico = Medico::findOrFail($id);
        if ($medico->delete()) {
            return new MedicoResource($medico);
        }
    }
}
