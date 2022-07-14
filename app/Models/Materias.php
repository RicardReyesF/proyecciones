<?php

namespace App\Models;

use App\Http\Controllers\Seriadas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    protected $table = 'materias';

    protected $primaryKey = 'materia';


    protected $guarded = [];


    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumnos_materias_models', 'materias_id', 'alumnos_id', 'materia', 'noControl',);
    }

    public function seriadas()
    {
        return $this->belongsToMany(Materias::class, 'seriadas', 'anterior_id', 'siguiente_id', 'materia', 'materia');
    }

    public function seriadasAtras()
    {
        return $this->belongsToMany(Materias::class, 'seriadas', 'siguiente_id', 'anterior_id', 'materia', 'materia');
    }
}
