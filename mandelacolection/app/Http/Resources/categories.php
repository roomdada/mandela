<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class categories extends JsonResource
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
            'nomcategorie'=>$this->nomcategorie,
            'description'=>$this->description,
            'active'=>$this->active,
        ];
    }
}
