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
        $alumnosMaterias = alumnosMateriasModel::query()->where('alumnos_id', '=', $id)->get()->toArray();
        $materias = Materias::all()->toArray();
        $alumnos = Alumno::query()->where('noControl', '=', $id)->get()->toArray();





        $arregloMaterias = array();
        $arregloMatAlumno = array();
        $arregloMateriaTotales = array();
        $rezagadas = array();
        $porcursar = array();
        $segundo = array();
        $primerSemestre = array();
        $c = array();



        foreach ($alumnosMaterias as $alumnoMateria) {
            $matAlumno = $alumnoMateria['materias_id'];
            array_push($arregloMatAlumno, $matAlumno);
        }
        foreach ($materias as $materia) {
            $materiaTotales = strval($materia['materia']);
            array_push($arregloMateriaTotales, $materiaTotales);
        }
        $arregloDif = array_diff($arregloMateriaTotales, $arregloMatAlumno);
        foreach ($arregloDif as $arregloD) {
            $diff = $arregloD;
            foreach ($materias as $materiadiff) {
                $pro = $materiadiff['materia'];
                if ($diff == $pro) {


                    array_push($arregloMaterias, $materiadiff);
                }
            }
        }
        foreach ($alumnos as $alumno) {
            $semestre = $alumno['semestre'];
            foreach ($arregloMaterias as $arregloMateria) {
                $semestreMaterias = $arregloMateria['semestre'];
                if ($semestreMaterias < $semestre) {
                    array_push($rezagadas, $arregloMateria);
                }
            }
        }



        foreach ($alumnos as $alumno) {
            $semestre = $alumno['semestre'];
            foreach ($arregloMaterias as $arregloMateria) {
                $semestreMaterias = $arregloMateria['semestre'];
                if ($semestreMaterias >= $semestre) {
                    array_push($porcursar, $arregloMateria);
                }
            }
        }


        //---------1ro a 2do--------//

        // uno
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            if ($semestre == 1) {
                array_push($primerSemestre, $rezagada);
            }
        }



        //dos
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if (in_array('1531', $rezagadas) == true) {
                $llave = array_search($rezagada['materia'] == '1531', $rezagadas);
                unset($rezagadas[$llave]);
                if ($semestre == 2) {
                    if ($materia == '1596') {
                        array_push($segundo, $rezagada);
                    }
                }
            }
        }


        //tres
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if (in_array('1532', $rezagadas) == true) {
                $llave = array_search($rezagada['materia'] == '1532', $rezagadas);
                unset($rezagadas[$llave]);
                if ($semestre == 2) {
                    if ($materia == '1597') {
                        array_unshift($segundo, $rezagada);
                    }
                }
            }
        }

        //cuatro
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if ($semestre == 2 && count($primerSemestre) <= 6 && $materia != '1597' && $materia != '1596') {
                array_push($primerSemestre, $rezagada);
                $llave = array_search($rezagada, $rezagadas);
                unset($rezagadas[$llave]);
            }
        }

        //cinco
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if ((in_array('1531', $rezagadas) == false) && (in_array('1532', $rezagadas) == false)) {
                if ($semestre == 2 && count($primerSemestre) <= 6) {

                    array_unshift($primerSemestre, $rezagada);
                } elseif ($semestre == 2 && count($primerSemestre) > 6) {
                    array_push($segundo, $rezagada);
                }
            }
        }

        //---------2do a 3ro--------//
        /*
            foreach ($rezagadas as $rezagada) {
                $semestre = $rezagada['semestre'];
                $materia = $rezagada['materia'];
                if($semestre == 2){
                    if(count($primerSemestre) <= 6 && in_array($materia,$primerSemestre)){
                        array_push($primerSemestre,$rezagada);
                    }elseif(count($primerSemestre) <= 6 && in_array($materia,$primerSemestre)){
                        array_push($segundo,$rezagada);
                    }elseif(count($primerSemestre) <= 6 && in_array($materia,$primerSemestre)){
                        array_push($c,$rezagada);
                    }
                }
            }

*/
        //seis
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if (in_array('1596', $rezagadas) == false) {
                $llave = array_search($rezagada['materia'] == '1596', $rezagadas);
                unset($rezagadas[$llave]);
                if ($semestre == 3) {
                    if ($materia == '1835' || $materia == '1052') {
                        if (count($segundo) <= 6) {
                            array_push($segundo, $rezagada);
                        } else {
                            array_push($c, $rezagada);
                        }
                    }
                }
            }
        }

        //siete
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if (in_array('1597', $rezagadas) == true) {
                $llave = array_search($rezagada['materia'] == '1597', $rezagadas);
                unset($rezagadas[$llave]);
                if ($semestre == 3) {
                    if ($materia == '1836') {
                        if (count($segundo) <= 6) {
                            array_push($segundo, $rezagada);
                        } else {
                            array_push($c, $rezagada);
                        }
                    }
                }
            }
        }


        //ocho
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if ($semestre == 3  && $materia != '1836' && ($materia != '1835' && $materia != '1052')) {
                if (count($primerSemestre) <= 6) {
                    array_push($primerSemestre, $rezagada);
                } elseif (count($segundo) <= 6) {
                    array_push($segundo, $rezagada);
                } else {
                    array_push($c, $rezagada);
                }
            }
        }


        //nueve
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if (in_array('1597', $rezagadas) == true && in_array('1596', $rezagadas) == true) {
                if ($semestre == 3 && count($primerSemestre) <= 6) {
                    array_push($primerSemestre, $rezagada);
                } elseif (count($segundo) <= 6) {
                    array_push($segundo, $rezagada);
                } else {
                    array_push($c, $rezagada);
                }
            }
        }

        //---------3ro a 4to--------//

        //diez
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if (in_array('1835', $rezagadas) == false) {
                $llave = array_search($rezagada['materia'] == '1835', $rezagadas);
                unset($rezagadas[$llave]);
                if ($semestre == 4) {
                    if ($materia == '1841') {
                        if (count($c) <= 6) {
                            array_push($c, $rezagada);
                        } else {
                            array_push($d, $rezagada);
                        }
                    }
                }
            }
        }

        //once
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if (in_array('1836', $rezagadas) == false) {
                $llave = array_search($rezagada['materia'] == '1836', $rezagadas);
                unset($rezagadas[$llave]);
                if ($semestre == 4) {
                    if ($materia == '1843') {
                        if (count($c) <= 6) {
                            array_push($c, $rezagada);
                        } else {
                            array_push($d, $rezagada);
                        }
                    }
                }
            }
        }
//return $primerSemestre;
    //return $segundo;
    //return $c;
        //doce
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if (in_array('1600', $rezagadas) == false && in_array('1052', $rezagadas) == false) {
                $llave = array_search($rezagada['materia'] == '1600', $rezagadas);
                unset($rezagadas[$llave]);
                $llave2 = array_search($rezagada['materia'] == '1052', $rezagadas);
                unset($rezagadas[$llave2]);
                if ($semestre == 4) {
                    if ($materia == '1838') {
                        if (count($c) <= 6) {
                            array_push($c, $rezagada);
                        } else {
                            array_push($d, $rezagada);
                        }
                    }
                }
            }
        }

        //trece
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if (in_array('1018', $rezagadas)) {
                $llave = array_search($rezagada['materia'] == '1018', $rezagadas);
                unset($rezagadas[$llave]);
                if ($semestre == 4) {
                    if ($materia == '1851') {
                        if (count($c) <= 6) {
                            array_push($c, $rezagada);
                        } else {
                            array_push($d, $rezagada);
                        }
                    }
                }
            }
        }

         //catorce
         foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if ($semestre == 4  && $materia != '1841' && ($materia != '1843' && $materia != '1863') && $materia != '1851' && $materia != '1838' ) {
                if (count($primerSemestre) <= 6) {
                    array_push($primerSemestre, $rezagada);
                } elseif (count($segundo) <= 6) {
                    array_push($segundo, $rezagada);
                } elseif(count($c) <= 6) {
                    array_push($c, $rezagada);
                }else {
                    array_push($d, $rezagada);
                }
            }
        }

        //quince
        foreach ($rezagadas as $rezagada) {
            $semestre = $rezagada['semestre'];
            $materia = $rezagada['materia'];
            if (in_array('1835', $rezagadas) == true && in_array('1836', $rezagadas) == true && in_array('1018', $rezagadas) == true && in_array('1052', $rezagadas) == true) {
                if ($semestre == 4 && count($primerSemestre) <= 6) {
                    array_push($primerSemestre, $rezagada);
                } elseif (count($segundo) <= 6) {
                    array_push($segundo, $rezagada);
                } elseif( count($c) <= 6) {
                    array_push($c,$rezagada);
                }else {
                    array_push($d,$rezagada);
                }
            }
        }

    //---------4to a 5to--------//
    //dieciseis
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1841', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1841', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 5) {
                if ($materia == '1842') {
                    if (count($d) <= 6) {
                        array_push($d, $rezagada);
                    } else {
                        array_push($e, $rezagada);
                    }
                }
            }
        }
    }

    //diecisiete
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1838', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1838', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 5) {
                if ($materia == '1849') {
                    if (count($d) <= 6) {
                        array_push($d, $rezagada);
                    } else {
                        array_push($e, $rezagada);
                    }
                }
            }
        }
    }

    //dieciocho
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1844', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1844', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 5) {
                if ($materia == '1848') {
                    if (count($d) <= 6) {
                        array_push($d, $rezagada);
                    } else {
                        array_push($e, $rezagada);
                    }
                }
            }
        }
    }

    //diecinueve
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if ($semestre == 5  && $materia != '1848' && $materia != '1849' && $materia != '1842'  ) {
            if (count($primerSemestre) <= 6) {
                array_push($primerSemestre, $rezagada);
            } elseif (count($segundo) <= 6) {
                array_push($segundo, $rezagada);
            } elseif(count($c) <= 6) {
                array_push($c, $rezagada);
            }elseif(count($d) <= 6) {
                array_push($d, $rezagada);
            }else{
                array_push($e,$rezagada);
            }
        }
    }

    //veinte
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1844', $rezagadas) == true && in_array('1838', $rezagadas) == true && in_array('1841', $rezagadas)== true) {
            if ($semestre == 5 && count($primerSemestre) <= 6) {
                array_push($primerSemestre, $rezagada);
            } elseif (count($segundo) <= 6) {
                array_push($segundo, $rezagada);
            } elseif( count($c) <= 6) {
                array_push($c,$rezagada);
            }elseif(count($d) <= 6) {
                array_push($d,$rezagada);
            }else {
                array_push($e,$rezagada);
            }
        }
    }


    //---------5to a 6to--------//

    //veintiuno
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1863', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1863', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 6) {
                if ($materia == '1867') {
                    if (count($e) <= 6) {
                        array_push($e, $rezagada);
                    } else {
                        array_push($f, $rezagada);
                    }
                }
            }
        }
    }

    //veintidos
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1847', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1847', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 6) {
                if ($materia == '1853') {
                    if (count($e) <= 6) {
                        array_push($e, $rezagada);
                    } else {
                        array_push($f, $rezagada);
                    }
                }
            }
        }
    }

    //veintitre
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1839', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1839', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 6) {
                if ($materia == '1856') {
                    if (count($e) <= 6) {
                        array_push($e, $rezagada);
                    } else {
                        array_push($f, $rezagada);
                    }
                }
            }
        }
    }

    //veinticuatro
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1848', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1848', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 6) {
                if ($materia == '1854') {
                    if (count($e) <= 6) {
                        array_push($e, $rezagada);
                    } else {
                        array_push($f, $rezagada);
                    }
                }
            }
        }
    }

    //veinticinco
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1851', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1851', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 6) {
                if ($materia == '1857') {
                    if (count($e) <= 6) {
                        array_push($e, $rezagada);
                    } else {
                        array_push($f, $rezagada);
                    }
                }
            }
        }
    }


    //veintiseis
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if ($semestre == 6  && $materia != '1857' && $materia != '1854' && $materia != '1856' && $materia != '1853' && $materia != '1867' ) {
            if (count($primerSemestre) <= 6) {
                array_push($primerSemestre, $rezagada);
            } elseif (count($segundo) <= 6) {
                array_push($segundo, $rezagada);
            } elseif(count($c) <= 6) {
                array_push($c, $rezagada);
            }elseif(count($d) <= 6) {
                array_push($d, $rezagada);
            }elseif(count($e) <= 6){
                array_push($e,$rezagada);
            }else {
                array_push($f,$rezagada);
            }
        }
    }

    //veintisiete
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1851', $rezagadas) == true && in_array('1848', $rezagadas) == true && in_array('1839', $rezagadas) == true && in_array('1847', $rezagadas) == true && in_array('1863', $rezagadas) == true) {
            if ($semestre == 6 && count($primerSemestre) <= 6) {
                array_push($primerSemestre, $rezagada);
            } elseif (count($segundo) <= 6) {
                array_push($segundo, $rezagada);
            } elseif( count($c) <= 6) {
                array_push($c,$rezagada);
            }elseif(count($d) <= 6) {
                array_push($d,$rezagada);
            }elseif(count($e) <= 6) {
                array_push($e,$rezagada);
            }else {
                array_push($f,$rezagada);
            }
        }
    }

    //---------6to a 7mo--------//

    //veintiocho
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1852', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1852', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 7) {
                if ($materia == '1858') {
                    if (count($f) <= 6) {
                        array_push($f, $rezagada);
                    } else {
                        array_push($g, $rezagada);
                    }
                }
            }
        }
    }

    //veintinueve
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1853', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1853', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 7) {
                if ($materia == '1859') {
                    if (count($f) <= 6) {
                        array_push($f, $rezagada);
                    } else {
                        array_push($g, $rezagada);
                    }
                }
            }
        }
    }

    //treinta
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1856', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1856', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 7) {
                if ($materia == '1861') {
                    if (count($f) <= 6) {
                        array_push($f, $rezagada);
                    } else {
                        array_push($g, $rezagada);
                    }
                }
            }
        }
    }

    //treinta y uno
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1857', $rezagadas) == false) {
            $llave = array_search($rezagada['materia'] == '1857', $rezagadas);
            unset($rezagadas[$llave]);
            if ($semestre == 7) {
                if ($materia == '1862') {
                    if (count($f) <= 6) {
                        array_push($f, $rezagada);
                    } else {
                        array_push($g, $rezagada);
                    }
                }
            }
        }
    }

    //treinta y dos
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if ($semestre == 7  && $materia != '1862' && $materia != '1861' && $materia != '1859' && $materia != '1858') {
            if (count($primerSemestre) <= 6) {
                array_push($primerSemestre, $rezagada);
            } elseif (count($segundo) <= 6) {
                array_push($segundo, $rezagada);
            } elseif(count($c) <= 6) {
                array_push($c, $rezagada);
            }elseif(count($d) <= 6) {
                array_push($d, $rezagada);
            }elseif(count($e) <= 6){
                array_push($e,$rezagada);
            }elseif((count($f) <= 6)) {
                array_push($f,$rezagada);
            }else{
                array_push($g,$rezagada);
            }
        }
    }

    //treinta y tres
    foreach ($rezagadas as $rezagada) {
        $semestre = $rezagada['semestre'];
        $materia = $rezagada['materia'];
        if (in_array('1852', $rezagadas) == true && in_array('1853', $rezagadas) == true && in_array('1856', $rezagadas) == true && in_array('1857', $rezagadas) == true && in_array('1863', $rezagadas) == true) {
            if ($semestre == 6 && count($primerSemestre) <= 6) {
                array_push($primerSemestre, $rezagada);
            } elseif (count($segundo) <= 6) {
                array_push($segundo, $rezagada);
            } elseif( count($c) <= 6) {
                array_push($c,$rezagada);
            }elseif(count($d) <= 6) {
                array_push($d,$rezagada);
            }elseif(count($e) <= 6) {
                array_push($e,$rezagada);
            }else {
                array_push($f,$rezagada);
            }
        }
    }

    //---------7mo a 8vo--------//






        /*
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
                        $dif = array_diff($rezagadas,$rezagada);
                        if ($semestre == 2) {
                            if ($materia == '1596' || $materia == '1597') {
                                array_push($segundo,$rezagada);

                        }


                    }


                }elseif ($semestre == 2) {

                        array_unshift($primerSemestre,$rezagada);


                }

            }

            */
        //return $segundo;
        //return $primerSemestre;
        //return $c;
        //return $rezagadas;
        //return $porcursar;
        //return $arregloMaterias;


        return view('Dashboard.proyeccion')->with(['arregloMaterias' => $arregloMaterias]);
    }
}
