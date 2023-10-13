<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cours extends Model
{
    use HasFactory;
    protected $hidden=[
        "created_at","updated_at"
    ];

    protected $guarded=[];
    public function professeur():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function classe():BelongsToMany
    {
        return $this->belongsToMany(Classe::class, "cours_classes")->withPivot("id","heures");
    }

    public function semestre():BelongsToMany
    {
        return $this->belongsToMany(Semestre::class, "cours_semestres")->withPivot("semestre_id");
    }

    public function module():BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

}

