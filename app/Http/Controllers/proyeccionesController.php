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





        $arregloMaterias = array();
        $arregloMatAlumno = array();
        $arregloMateriaTotales = array();
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
                if($diff == $pro)
                {
                    array_push($arregloMaterias,$materiadiff['nombre']);
                }
            }
        }

        return view('Dashboard.proyeccion')->with(['arregloMaterias'=>$arregloMaterias]);
    }

    /*
    public function proyeccion($id)
    {
        $materias = alumnosMateriasModel::query()->where('alumnos_id','=',$id)->get()->toArray();


        $arregloMaterias= array();
        $proyeccion= array();
        $materiasPrimerSemestre  = array('1532','1533','1534','1535','1531','1577');
        $materiasSegundoSemestre = array('1596','1597','1598','1837','1840','1600');
        $materiasTercerSemestre  = array('1835','1836','1599','1536','1018','1052');
        $materiasCuartoSemestre  = array('1838','1841','1843','1844','1851','1863');
        $materiasQuintoSemestre  = array('1849','1842','1845','1847','1848','1839');
        $materiasSextoSemestre   = array('1852','1853','1854','1856','1857','1867');
        $materiasSeptimoSemestre = array('1858','1850','1862','1859','1860','1861');
        $materiasOctavoSemestre  = array('1864','1855','1865','1866','2308','2310');
        $materiasNovenoSemestre  = array('2311','2309','2307');


        foreach($materias as $materia)
        {
            $mat = $materia['materias_id'];
            array_push($arregloMaterias,$mat);

        }
        $primerSemestre     = array_diff($materiasPrimerSemestre,$arregloMaterias);
        $segundoSemestre    = array_diff($materiasSegundoSemestre,$arregloMaterias);
        $tercerSemestre     = array_diff($materiasTercerSemestre,$arregloMaterias);
        $cuartoSemestre     = array_diff($materiasCuartoSemestre,$arregloMaterias);
        $quintoSemestre     = array_diff($materiasQuintoSemestre,$arregloMaterias);
        $sextoSemestre      = array_diff($materiasSextoSemestre,$arregloMaterias);
        $septimoSemestre    = array_diff($materiasSeptimoSemestre,$arregloMaterias);
        $octavoSemestre     = array_diff($materiasOctavoSemestre,$arregloMaterias);
        $novenoSemestre     = array_diff($materiasNovenoSemestre,$arregloMaterias);
        array_push($proyeccion,$primerSemestre,$segundoSemestre,$tercerSemestre,$cuartoSemestre,$quintoSemestre,$sextoSemestre,$septimoSemestre,$octavoSemestre,$novenoSemestre);
        return $proyeccion;

    }
    */
}
