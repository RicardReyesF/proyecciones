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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function generate(string $no_control = '20280774')
    {
        /** @var Alumno $alumno */
        $alumno = Alumno::findOrfail($no_control);

        $pendientesSeriadas = $alumno->getMateriasPendientes();
        $pendientesNoSeriadas = $alumno->getMateriasPendientes(false);

        $agregadas = collect();
        $semestreActual = $alumno->semestre;

        $c = 1;

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

            if ($posiblesSeriadas->count() + $posiblesNoSeriadas->count() == 0) break;

            if ($posiblesSeriadas->count() + $posiblesNoSeriadas->count() < 7) {
                $semestreActual++;
                continue;
            }

            $semestreAux = collect();

            while ($semestreAux->count() != 7 && $posiblesSeriadas->count() + $posiblesNoSeriadas->count() != 0) {
                if ($posiblesSeriadas->count() > 0) {
                    $semestreAux->push($posiblesSeriadas->pop());
                    continue;
                }

                if ($posiblesNoSeriadas->count() > 0) $semestreAux->push($posiblesNoSeriadas->pop());

            }

            $agregadas = $agregadas->merge($semestreAux);
            $pendientesSeriadas = $pendientesSeriadas->whereNotIn('materia', $agregadas->pluck('materia')->toArray());
            $pendientesNoSeriadas = $pendientesNoSeriadas->whereNotIn('materia', $agregadas->pluck('materia')->toArray());

        }

        $semestres = $this->dividirPorSemestres($agregadas);

        return view('proyeccion-v2', compact(['semestres']));

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

    /**
     * @param Collection $materias
     * @return Collection
     */
    private function dividirPorSemestres($materias)
    {
        $numeroSemestres = ((int)$materias->count() / 7);
        $semestres = collect();

        for ($i = 0; $i < $numeroSemestres; $i++) {
            $materiasSemestre = collect();
            for ($j = 0; $j < 7; $j++) {
                $materiasSemestre->push($materias->pop());
            }
            $semestres->push($materiasSemestre);
        }

        if ($materias->count() > 0) $semestres->push($materias->all());

        return $semestres->reverse()->values();
    }

}
