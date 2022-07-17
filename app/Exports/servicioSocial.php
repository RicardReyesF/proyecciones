<?php

namespace App\Exports;

use App\Models\Alumno;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Support\Facades\DB;

class servicioSocial implements FromQuery
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Alumno::query()->where('creditosA','>=',144);
    }
}
