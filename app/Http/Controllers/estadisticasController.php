<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Carbon\CarbonConverterInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class estadisticasController extends Controller
{
    public function estadisticas()
    {
        if (Auth::user()->carrera == 505 ) {

        $mujeres = DB::select('select * from alumnos where genero LIKE "F" AND creditosA BETWEEN 144 AND 240 AND planDeEstudio == 505');
        $hombres = DB::select('select * from alumnos where genero LIKE "M" AND creditosA BETWEEN 144 AND 240 AND planDeEstudio == 505');

        $mujeresR = DB::select('select * from alumnos where genero LIKE "F" AND creditosA >= 240 AND planDeEstudio == 505');
        $hombresR = DB::select('select * from alumnos where genero LIKE "M" AND creditosA >= 240 AND planDeEstudio == 505');


        return view('Dashboard.estadisticas')->with(array('mujeres' => $mujeres))->with(array('hombres' => $hombres))->with(array('hombresR' => $hombresR))->with(array('mujeresR' => $mujeresR)) ;
        }elseif (Auth::user()->carrera == 305) {
            $mujeres = DB::select('select * from alumnos where genero LIKE "F" AND creditosA BETWEEN 144 AND 240 AND planDeEstudio = 305');
            $hombres = DB::select('select * from alumnos where genero LIKE "M" AND creditosA BETWEEN 144 AND 240 AND planDeEstudio = 305');

            $mujeresR = DB::select('select * from alumnos where genero LIKE "F" AND creditosA >= 240 AND planDeEstudio = 305');
            $hombresR = DB::select('select * from alumnos where genero LIKE "M" AND creditosA >= 240 AND planDeEstudio = 305');


            return view('Dashboard.estadisticas')->with(array('mujeres' => $mujeres))->with(array('hombres' => $hombres))->with(array('hombresR' => $hombresR))->with(array('mujeresR' => $mujeresR)) ;

        }elseif (Auth::user()->carrera == 1) {
            $mujeres = DB::select('select * from alumnos where genero LIKE "F" AND creditosA BETWEEN 144 AND 240');
            $hombres = DB::select('select * from alumnos where genero LIKE "M" AND creditosA BETWEEN 144 AND 240');

            $mujeresR = DB::select('select * from alumnos where genero LIKE "F" AND creditosA >= 240');
            $hombresR = DB::select('select * from alumnos where genero LIKE "M" AND creditosA >= 240');


            return view('Dashboard.estadisticas')->with(array('mujeres' => $mujeres))->with(array('hombres' => $hombres))->with(array('hombresR' => $hombresR))->with(array('mujeresR' => $mujeresR)) ;

        }

    }
}
