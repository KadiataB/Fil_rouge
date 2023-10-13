<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoursProf extends Model
{
    use HasFactory;

    public function cours():BelongsTo
    {
        return $this->belongsTo(Cours::class);
    }

    public function professeur():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
