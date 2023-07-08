<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tarea;
use App\Models\User;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable=[
     'título',
     'descripción',
     'fecha_inicio',
     'fecha_final',
    ];
    public function user(){
        return $this->belongsToMany(User::class,'proyecto_user');
    }

    

    public function tareas()
{
    return $this->hasMany(Tarea::class);
}
}
