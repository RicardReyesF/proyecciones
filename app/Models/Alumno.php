<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos';

    protected $primaryKey = 'noControl';

    protected $guarded = [];

    public function materias()
    {
        return $this->belongsToMany(Materias::class, 'alumnos_materias_models', 'alumnos_id', 'materias_id', 'noControl', 'materia');
    }

    /**
     * Obtener las materias pendientes del alumno seriadas o no seriadas ordenadas por semestre de menor a mayor
     *
     * @param bool $seriadas
     * @return Collection
     */
    public function getMateriasPendientes(bool $seriadas = true)
    {
        $materias = Materias::query()
            ->whereNotIn('materia', $this->materias->pluck('materia')->toArray())
            ->orderBy('semestre', 'ASC');

        if ($seriadas) {
            return $materias->where(function ($query) {
                $query->whereHas('seriadas')
                    ->orWhereHas('seriadasAtras');
            })->get();
        }

        return $materias->where(function ($query) {
            $query->doesntHave('seriadas')
                ->doesntHave('seriadasAtras');
        })->get();

    }
}
