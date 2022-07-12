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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function generate(string $no_control = '20280774')
    {
        /** @var Alumno $alumno */
        $alumno = Alumno::findOrfail($no_control);

        $pendientesSeriadas = $alumno->getMateriasPendientes();
        $pendientesNoSeriadas = $alumno->getMateriasPendientes(false);

        return $pendientesSeriadas->where('semestre', '<=', $alumno->semestre);
    }
}
