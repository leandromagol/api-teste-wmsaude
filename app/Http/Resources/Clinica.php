<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Clinica extends JsonResource
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
            'cnes' =>$this->cnes,
            'cnes'=>$this->cnes,
            'cnpj'=>$this->cnpj
        ];
    }
    public function with($request){
        return [
            'version'=>'1.0.0',
            'author_url' => url('https://github.com/leandromagol'),
        ];
    }
}
