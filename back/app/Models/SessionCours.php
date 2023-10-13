<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SessionCours extends Model
{
    use HasFactory;


    protected $guarded=[];
    public $timestamps = false;
    protected $hidden=[
        "created_at","updated_at"
    ];

    public function classe():BelongsToMany
    {
        return $this->belongsToMany(Classe::class, "classe_sessions");
    }

    public function coursClasse():BelongsTo
    {
        return $this->belongsTo(CoursClasse::class);
    }
}
