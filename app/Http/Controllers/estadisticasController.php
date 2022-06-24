<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class estadisticasController extends Controller
{
    public function estadisticas()
    {
        return view('Dashboard.estadisticas');
    }
}
