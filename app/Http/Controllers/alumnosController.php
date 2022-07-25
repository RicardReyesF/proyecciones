<?php

namespace App\Http\Controllers;

use App\Imports\AlumnosImport;
use App\Imports\MateriaAlumnosImport;
use Illuminate\Http\Request;
use App\Models\Alumno;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;



class alumnosController extends Controller
{
    public function alumnos()
    {
        if (Auth::user()->carrera == 1) {
            $alumnos=Alumno::all();
            return view('Dashboard.alumnos',array('alumnos'=> $alumnos));
        }else {
            $user=Auth::user()->carrera;
            $alumnos=DB::table('alumnos')->where('planDeEstudio','=',$user)->get();
            return view('Dashboard.alumnos',array('alumnos'=> $alumnos));

        }
    }

    public function importar(Request $request)
    {

        $request->validate([
            'documento' => 'required|max:10000|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('documento');
        Excel::import(new AlumnosImport, $file);


        return redirect()->route('Alumnos');
    }


}
