<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'idClase',
        'estado',
        'idEstudiante'
    ];

    public function Clase(){
        return $this->hasOne('App\Models\Clase', 'id', 'idClase');
    }

    public function User(){
        return $this->hasOne('App\Models\User', 'id', 'idEstudiante');
    }
}
