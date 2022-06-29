<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\alumnosMateriasModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToArray;

class proyeccionesController extends Controller
{
    public function proyeccion($id)
    {
        $alumnos = alumnosMateriasModel::query()->where('alumnos_id','=',$id)->get()->toArray();
        //return $alumnos;


        foreach($alumnos as $alumno)
        $arregloMaterias= array();
        $proyeccion= array();
        $materiasPrimerSemestre  = array('1532','1533','1534','1535','2234','1531','1577');
        $materiasSegundoSemestre = array('1596','1597','1598','1837','1840','1600');
        $materiasTercerSemestre  = array('1835','1836','1599','1536','1018','1052');
        $materiasCuartoSemestre  = array('1838','1841','1843','1844','1851','1863');
        $materiasQuintoSemestre  = array('1849','1842','1845','1847','1848','1839');
        $materiasSextoSemestre   = array('1852','1853','1854','1856','1857','1867');
        $materiasSeptimoSemestre = array('1858','1850','1862','1859','1860','1861');
        $materiasOctavoSemestre  = array('1864','1855','1865','1866','2308','2310');
        $materiasNovenoSemestre  = array('2311','2309','2307');
        {
            $materias = $alumno['materias_id'];
            array_push($arregloMaterias,$materias);
            $primerSemestre     = array_intersect($arregloMaterias,$materiasPrimerSemestre);
            $segundoSemestre    = array_intersect($arregloMaterias,$materiasSegundoSemestre);
            $tercerSemestre     = array_intersect($arregloMaterias,$materiasTercerSemestre);
            $cuartoSemestre     = array_intersect($arregloMaterias,$materiasCuartoSemestre);
            $quintoSemestre     = array_intersect($arregloMaterias,$materiasQuintoSemestre);
            $sextoSemestre      = array_intersect($arregloMaterias,$materiasSextoSemestre);
            $septimoSemestre    = array_intersect($arregloMaterias,$materiasSeptimoSemestre);
            $octavoSemestre     = array_intersect($arregloMaterias,$materiasOctavoSemestre);
            $novenoSemestre     = array_intersect($arregloMaterias,$materiasNovenoSemestre);
            array_push($proyeccion,$primerSemestre,$segundoSemestre,$tercerSemestre,$cuartoSemestre,$quintoSemestre,$sextoSemestre,$septimoSemestre,$octavoSemestre,$novenoSemestre);
            return $proyeccion;
        }

    }
}
