<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class commande extends JsonResource
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
            'article'=>$this->article,
            'quantite'=>$this->quantite,
            'prix_total'=>$this->prix_total,
            'date_commande'=>$this->date_commande,
            'active'=>$this->active,
        ];
    }
}
