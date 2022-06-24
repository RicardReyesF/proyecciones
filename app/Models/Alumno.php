<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = [
    'carrera',
    'noControl',
    'nombre',
    'planDeEstudio',
    'semestre',
    'estatus',
    'genero',
    'creditosPlan',
    'creditosA',
    'creditosQueDebeTener',
    'promedio',
    ];

    public function materias()
    {
        return $this->belongsToMany(Materias::class);
    }

}
