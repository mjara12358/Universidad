<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'semestre',
        'creditos',
        'idProfesor'
    ];

    public function User(){
        // return $this->belongsTo(Materia::class, 'idMateria');
        return $this->hasOne('App\Models\User', 'id', 'idProfesor');
    }
}
