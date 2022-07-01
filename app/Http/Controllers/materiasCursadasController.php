<?php

namespace App\Http\Controllers;

use App\Exports\materiasCursadasComplementarios;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class materiasCursadasController extends Controller
{
    public function export()
    {
        return Excel::download(new materiasCursadasComplementarios,'Materias.xlsx');
    }
}
