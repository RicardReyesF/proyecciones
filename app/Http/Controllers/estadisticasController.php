<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class estadisticasController extends Controller
{
    public function estadisticas()
    {

        $mujeres = DB::select('select * from alumnos where genero LIKE "F" AND creditosA BETWEEN 144 AND 240');
        $hombres = DB::select('select * from alumnos where genero LIKE "M" AND creditosA BETWEEN 144 AND 240');

        $mujeresR = DB::select('select * from alumnos where genero LIKE "F" AND creditosA >= 240');
        $hombresR = DB::select('select * from alumnos where genero LIKE "M" AND creditosA >= 240');


        return view('Dashboard.estadisticas')->with(array('mujeres' => $mujeres))->with(array('hombres' => $hombres))->with(array('hombresR' => $hombresR))->with(array('mujeresR' => $mujeresR)) ;
    }
}
