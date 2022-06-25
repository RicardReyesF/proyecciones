<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $primaryKey = 'noControl';

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
        return $this->belongsToMany(Materias::class,'alumnos_materias_models','alumnos_id','materias_id','noControl','materia');
    }

}
