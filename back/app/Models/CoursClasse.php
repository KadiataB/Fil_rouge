<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoursClasse extends Model
{
    use HasFactory;

    protected $hidden=[
        "created_at",
        "updated_at"
    ];
    protected $guarded=[];

    public function cours():BelongsTo
    {
        return $this->belongsTo(Cours::class);
    }

    public function classe():BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }
}
