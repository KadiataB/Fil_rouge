<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $hidden=[
        "created_at","updated_at"
    ];


    public function semestres():HasMany
    {
        return $this->hasMany(Semestre::class);
    }
}
