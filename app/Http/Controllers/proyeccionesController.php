<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\alumnosMateriasModel;
use App\Models\Materias;
use Maatwebsite\Excel\Concerns\ToArray;

class proyeccionesController extends Controller

{

    public function proyeccion($id)
    {
        $alumnosMaterias = alumnosMateriasModel::query()->where('alumnos_id','=',$id)->get()->toArray();
        $materias = Materias::all()->toArray();
        $alumnos = Alumno::query()->where('noControl','=',$id)->get()->toArray();





        $arregloMaterias = array();
        $arregloMatAlumno = array();
        $arregloMateriaTotales = array();
        $rezagadas = array();
        $porcursar = array();
        $primerSemestre = array();
        $segundo = array();
        $rez=array();



        foreach($alumnosMaterias as $alumnoMateria)
            {
            $matAlumno= $alumnoMateria['materias_id'];
            array_push($arregloMatAlumno,$matAlumno);

            }
        foreach($materias as $materia)
            {
                $materiaTotales= strval($materia['materia']);
                array_push($arregloMateriaTotales,$materiaTotales);
            }
        $arregloDif=array_diff($arregloMateriaTotales,$arregloMatAlumno);
        foreach($arregloDif as $arregloD)
        {
            $diff= $arregloD;
            foreach($materias as $materiadiff)
            {
                $pro = $materiadiff['materia'];
                if($diff == $pro )
                {


                    array_push($arregloMaterias,$materiadiff);
                }
            }
        }
            foreach ($alumnos as $alumno) {
                $semestre = $alumno['semestre'];
                    foreach ($arregloMaterias as $arregloMateria) {
                        $semestreMaterias = $arregloMateria['semestre'];
                        if ($semestreMaterias < $semestre) {
                            array_push($rezagadas,$arregloMateria);

                        }
                    }
            }

            foreach ($alumnos as $alumno) {
                $semestre = $alumno['semestre'];
                    foreach ($arregloMaterias as $arregloMateria) {
                        $semestreMaterias = $arregloMateria['semestre'];
                        if ($semestreMaterias >= $semestre) {
                            array_push($porcursar,$arregloMateria);

                        }
                    }
            }

            foreach ($rezagadas as $rezagada) {
                $semestre = $rezagada['semestre'];
                if($semestre == 1){
                    array_push($primerSemestre,$rezagada);
                }
            }

            foreach ($rezagadas as $rezagada){
                $semestre = $rezagada['semestre'];
                $materia = $rezagada['materia'];
                if (in_array('1531',$rezagadas)  == false || in_array('1532',$rezagadas) == false ) {
                        if ($semestre == 2) {
                            if ($materia == '1596' || $materia == '1597') {
                                array_push($segundo,$rezagada);

                        }


                    }

                }elseif ($semestre == 2) {

                        array_unshift($primerSemestre,$rezagada);


                }

            }



        return $rezagadas;
        return $porcursar;
        return $arregloMaterias;


        return view('Dashboard.proyeccion')->with(['arregloMaterias'=>$arregloMaterias]);
    }
}
