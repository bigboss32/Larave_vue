<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;

class Tarea extends Model
{
    use HasFactory;
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
