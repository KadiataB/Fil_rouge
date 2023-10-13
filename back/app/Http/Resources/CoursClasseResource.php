<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursClasseResource extends JsonResource
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
            "classe"=>CLasseResource::make($this->classe),
            "cours"=>CoursResource::make($this->cours),
            "heures"=>$this->heures
        ];
    }
}
