<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "hd"=>$this->hd,
            "hf"=>$this->hf,
            "mode"=>$this->mode,
            "etat"=>$this->etat,
            "duree"=>$this->duree,
            "date"=>$this->date,
            "cours_classe"=>CoursClasseResource::make($this->coursClasse)
        ];
    }
}
