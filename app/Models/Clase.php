<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clase extends Model
{
    use HasFactory;

    protected $fillable = [
        'idMateria',
        'fecha',
        'tema',
        'actividad',
        'recursos',
        'observaciones',
        'estrategia'
    ];

    public function Materia(){
        return $this->hasOne('App\Models\Materia', 'id', 'idMateria');
    }
}
