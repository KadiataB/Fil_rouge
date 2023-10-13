<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleProfesseur extends Model
{
    use HasFactory;
    protected $hidden=[
        "created_at","updated_at"
    ];

    public function module():BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function professeur():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
