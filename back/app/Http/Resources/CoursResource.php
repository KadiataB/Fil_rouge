<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursResource extends JsonResource
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
            // "module"=>ModuleResource::collection($this->module),
            "module"=>$this->module->libelle,
            "professeur"=>UserResource::make($this->professeur),
            "classe"=>$this->classe->map(function($c){
                return [
                    "id"=>$c->pivot->id,
                    "heures"=>$c->pivot->heures
                ];
            }),
            "semestre"=>$this->semestre->map(function($s){
                return [
                    "libelle"=>$s->libelle
                ];
            })
        ];
    }
}
