<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleProfResource extends JsonResource
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
            "heures"=>$this->heures,
            "professeur"=>UserResource::make($this->professeur),
            "module_id"=>$this->module_id
            // "professeur"=>$this->professeur
        ];
    }
}
