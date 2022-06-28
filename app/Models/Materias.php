<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias extends Model


{

    protected $primaryKey = 'materia';

    protected $fillable = [
        'materia',
        'nombre',
        'creditos',
        'carrera',
        'semestre'
    ];


    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class,'alumnos_materias_models','materias_id','alumnos_id','materia','noControl',);
    }

}
