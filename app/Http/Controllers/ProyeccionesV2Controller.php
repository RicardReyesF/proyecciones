<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Materias;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProyeccionesV2Controller extends Controller
{
    /**
     * Generar proyeccion para el alumno dado
     *
     * @param string $no_control
     * @return array
     */
    public function generate(string $no_control = '20280774')
    {
        /** @var Alumno $alumno */
        $alumno = Alumno::findOrfail($no_control);

        $pendientesSeriadas = $alumno->getMateriasPendientes();
        $pendientesNoSeriadas = $alumno->getMateriasPendientes(false);

        $agregadas = collect();

        while ($pendientesSeriadas->count() != 0 && $pendientesNoSeriadas->count() != 0) {

            $posiblesSeriadas = $pendientesSeriadas->whereNotIn('materia', $agregadas->pluck('materia')->toArray());
            $posiblesNoSeriadas = $pendientesNoSeriadas->whereNotIn('materia', $agregadas->pluck('materia')->toArray());

            $semestreAux = collect();

            while ($semestreAux->count() != 7) {

            }
        }

        return [
            'modify'   => $pendientesSeriadas->where('semestre', '<=', 4),
            'original' => $pendientesNoSeriadas
        ];
    }


}
