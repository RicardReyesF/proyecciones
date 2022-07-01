<?php

namespace App\Http\Controllers;

use App\Exports\servicioSocial;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
class servicioController extends Controller
{
    public function export()
    {
        return Excel::download(new servicioSocial, 'servicio.xlsx');
    }
}

