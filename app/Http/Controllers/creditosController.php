<?php

namespace App\Http\Controllers;

use App\Exports\creditosComplementarios;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class creditosController extends Controller
{
    public function export()
    {
        return Excel::download(new creditosComplementarios, 'Creditos.xlsx');
    }
}
