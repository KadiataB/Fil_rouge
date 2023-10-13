<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classe extends Model
{
    use HasFactory;

    protected $hidden=[
        "created_at","updated_at"
    ];

    protected $guarded=[];
    public function anneeScolaire():BelongsTo
    {
        return $this->belongsTo(AnneeScolaire::class);
    }


    public function cours():BelongsToMany
    {
        return $this->belongsToMany(Cours::class, "cours_classes");
    }

    public function session():BelongsToMany
    {
        return $this->belongsToMany(SessionCours::class,"classe_sessions");
    }
}

