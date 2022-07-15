<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Materias;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProyeccionesV2Controller extends Controller
{
    const MATERIAS_POR_SEMESTRE = 7;

    /**
     * Generar proyeccion para el alumno dado
     *
     * @param string $no_control
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function generate(string $id)
    {
        /** @var Alumno $alumno */
        $alumno = Alumno::findOrfail($id);

        $pendientesSeriadas = $alumno->getMateriasPendientes();

        $pendientesNoSeriadas = $alumno->getMateriasPendientes(false);

        $agregadas = collect();
        $semestreActual = $alumno->semestre;
        $semestres = [];

        while ($pendientesSeriadas->count() != 0 && $pendientesNoSeriadas->count() != 0) {
            // Obtener las materias seriadas que aun no se han contemplado en la proyeccion
            $posiblesSeriadas = $pendientesSeriadas->whereNotIn('materia', $agregadas->pluck('materia')->toArray());

            // Quitar las materias seriadas que tienen otras materias que aun no se han agregado a la proyeccion
            $posiblesSeriadas = $this->getPosiblesSeriadas($posiblesSeriadas);

            // Obtener solo las materias seriadas que sean menores o iguales al semestre proyectado
            $posiblesSeriadas = $posiblesSeriadas->where('semestre', '<=', $semestreActual);

            // Obtener las materias no seriadas que aun no se han contemplado en la proyeccion
            $posiblesNoSeriadas = $pendientesNoSeriadas->whereNotIn('materia', $agregadas->pluck('materia')->toArray());

            // Obtener solo las materias no seriadas que sean menores o iguales al semestre proyectado
            $posiblesNoSeriadas = $posiblesNoSeriadas->where('semestre', '<=', $semestreActual);

            if ($pendientesSeriadas->count() + $pendientesNoSeriadas->count() == 0 || $semestreActual == 30) break;

            if ($posiblesSeriadas->count() + $posiblesNoSeriadas->count() < self::MATERIAS_POR_SEMESTRE) {
                $semestreActual++;
                continue;
            }

            $semestreAux = collect();

            while ($semestreAux->count() != self::MATERIAS_POR_SEMESTRE && $posiblesSeriadas->count() + $posiblesNoSeriadas->count() != 0) {

                if ($posiblesSeriadas->count() > 0) {
                    $semestreAux->push($posiblesSeriadas->shift());
                    continue;
                }

                if ($posiblesNoSeriadas->count() > 0) $semestreAux->push($posiblesNoSeriadas->shift());

            }


            $agregadas = $agregadas->merge($semestreAux);
            $semestres[] = $semestreAux;
            $pendientesSeriadas = $pendientesSeriadas->whereNotIn('materia', $agregadas->pluck('materia')->toArray());
            $pendientesNoSeriadas = $pendientesNoSeriadas->whereNotIn('materia', $agregadas->pluck('materia')->toArray());

        }

        while ($pendientesSeriadas->count() != 0 || $pendientesNoSeriadas->count() != 0) {
            $posiblesSeriadas = $this->getPosiblesSeriadas($pendientesSeriadas);
            $posiblesNoSeriadas = $pendientesNoSeriadas;

            $semestreAux = collect();
            while ($posiblesSeriadas->count() != 0 || $posiblesNoSeriadas->count() != 0) {
                if ($posiblesSeriadas->count() > 0) {
                    $semestreAux->push($posiblesSeriadas->shift());
                    continue;
                }
                if ($posiblesNoSeriadas->count() > 0) $semestreAux->push($posiblesNoSeriadas->shift());
            }

            $semestres[] = $semestreAux;
            $pendientesSeriadas = $pendientesSeriadas->whereNotIn('materia', $semestreAux->pluck('materia')->toArray());
            $pendientesNoSeriadas = $pendientesNoSeriadas->whereNotIn('materia', $semestreAux->pluck('materia')->toArray());
        }

        return view('Dashboard.proyeccion', compact(['semestres']));

    }

    /**
     * @param Collection $pendientesSeriadas
     * @return Collection
     */
    private function getPosiblesSeriadas($pendientesSeriadas)
    {
        $noPermitidas = [];

        /** @var Materias $materiaPosible */
        foreach ($pendientesSeriadas as $materiaPosible) {
            $noPermitidas = array_merge($noPermitidas, $materiaPosible->seriadas->pluck('materia')->toArray());
        }

        return $pendientesSeriadas->whereNotIn('materia', $noPermitidas);
    }

}
