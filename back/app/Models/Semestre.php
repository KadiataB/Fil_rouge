<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Semestre extends Model
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
        return $this->belongsToMany(Cours::class, "cours_profs");
    }
}
