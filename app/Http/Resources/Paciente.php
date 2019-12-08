<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Paciente extends JsonResource
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
            'nome' => $this->nome,
            'sexo' =>$this->sexo,
            'idade'=>$this->idade,
            'email'=>$this->email
        ];
    }
    public function with($request){
        return [
            'version'=>'1.0.0',
            'author_url' => url('https://github.com/leandromagol'),
        ];
    }
}
