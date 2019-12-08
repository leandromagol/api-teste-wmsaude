<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Consulta extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'id_medico' => $this->id_medico,
            'id_paciente' =>$this->id_paciente,
            'id_clinica'=>$this->id_clinica,
            'data_consulta'=>$this->data_consulta,
            'status'=>$this->status,
            'nomePaciente'=>$this->nomePaciente,
            'nomeMedico'=>$this->nomeMedico,
            'nomeClinica'=>$this->nomeClinica
        ];
    }
    public function with($request){
        return [
            'version'=>'1.0.0',
            'author_url' => url('https://github.com/leandromagol'),
        ];
    }
}
