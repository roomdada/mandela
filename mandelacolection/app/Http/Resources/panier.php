<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class panier extends JsonResource
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
            'client_id'=>$this->client_id,
            'commande_id'=>$this->commande_id,
            'lieu_commande'=>$this->lieu_commande,
            'active'=>$this->active,
        ];
    }
}
