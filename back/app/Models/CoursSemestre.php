<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoursSemestre extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function cours():BelongsTo
    {
        return $this->belongsTo(Cours::class);
    }

    public function semestre():BelongsTo
    {
        return $this->belongsTo(Semestre::class);
    }
}
