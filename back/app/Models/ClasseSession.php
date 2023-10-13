<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClasseSession extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $hidden=[
        "created_at","updated_at"
    ];

    public function classe():BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    public function sesionCours():BelongsTo
    {
        return $this->belongsTo(SessionCours::class);
    }
}
