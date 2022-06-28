<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Models\Materias;

class materiasController extends Controller
{
    public function materias($id)
    {
        $alumnos = Alumno::query()->with('materias')->find($id);


        return view('Dashboard.materias',array('alumnos' => $alumnos));
    }


}
