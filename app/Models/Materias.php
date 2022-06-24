<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'creditos',
        'carrera',
        'semestre'
    ];


    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class);
    }

}
