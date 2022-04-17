<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class categorie extends JsonResource
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
            'id'=> $this->id,
            'nom_categorie'=>$this->nom_categorie,
            'description'=>$this->description,
            'active'=>$this->active,
        ];
    }
}
