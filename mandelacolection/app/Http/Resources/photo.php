<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class photo extends JsonResource
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
            'article_id'=>$this->article_id,
            'chemin'=>$this->chemin,
            'active'=>$this->active,
        ];
    }
}
