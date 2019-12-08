<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Consulta as ConsultaResource;
use App\Consulta;
class ConsultaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $consulta = Consulta::join('medicos','consultas.id_medico','=','medicos.id')
                                    ->join('pacientes','consultas.id_paciente','=','pacientes.id')
                                    ->join('clinicas','consultas.id_clinica','=','clinicas.id')
                                    ->select('consultas.*','pacientes.nome as nomePaciente','medicos.nome as nomeMedico','clinicas.nome as nomeClinica')
                                    ->paginate(5); 
        return ConsultaResource::collection($consulta);
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
        $consulta = $request->isMethod('put') ? Consulta::findOrFail($request->id) : new Consulta;
        $consulta->id = $request->input('id');
        $consulta->id_medico = $request->input('id_medico');
        $consulta->id_paciente = $request->input('id_paciente');
        $consulta->id_clinica = $request->input('id_clinica');
        $consulta->data_consulta = $request->input('data_consulta');
        $consulta->status = $request->input('status');

        if ($consulta->save()) {
            return new ConsultaResource($consulta);
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
        //
        $consulta = Consulta::find($id);
        if (! $consulta) {
            return response()->json(['data'=>['msg'=>'Consulta não encontrado na base de dados']]);
        }else{
            return new ConsultaResource($consulta);
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
           //
           $consulta = Consulta::findOrFail($id);
           if ($consulta->delete()) {
               return new ConsultaResource($consulta);
           }
    }
}
