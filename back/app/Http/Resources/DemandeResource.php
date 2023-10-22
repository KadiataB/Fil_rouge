<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DemandeResource extends JsonResource
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
            "motif"=>$this->motif,
            "etat"=>$this->etat,
            "session_cours"=>SessionResource::make($this->session_cours),
            "professeur"=>UserResource::make($this->professeur)
        ];
    }
}