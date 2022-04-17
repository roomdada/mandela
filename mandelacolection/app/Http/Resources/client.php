<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class client extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'nom_client'=>$this->nom_client,
            'prenom_client'=>$this->prenom_client,
            'adresse'=>$this->adresse,
            'contact'=>$this->contact,
            'active'=>$this->active,
        ];
    }
}
