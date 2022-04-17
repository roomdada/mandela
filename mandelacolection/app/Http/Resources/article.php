<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class article extends JsonResource
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
            'categorie_id'=>$this->categorie_id,
            'nom_article'=>$this->nom_article,
            'descrip_article'=>$this->descrip_article,
            'prix_article'=>$this->prix_article,
            'active'=>$this->active,
        ];
    }
}
