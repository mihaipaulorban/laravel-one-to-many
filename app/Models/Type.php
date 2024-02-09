<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Questa è la classe Type che estende Model
class Type extends Model
{
    use HasFactory;

    // Definisce una relazione hasMany con la classe Project
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
