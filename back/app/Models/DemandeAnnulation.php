<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DemandeAnnulation extends Model
{
    use HasFactory;

    protected $hidden=[
        "created_at","updated_at"
    ];

    protected $guarded=[];

    public function session_cours():BelongsTo
    {
        return $this->belongsTo(SessionCours::class);
    }

    public function professeur():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
