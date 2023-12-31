<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Module extends Model
{
    use HasFactory;

    protected $hidden=[
        "created_at","updated_at"
    ];

    public function professeur():BelongsToMany
    {
        return $this->belongsToMany(User::class,"module_professeurs");
    }

}
