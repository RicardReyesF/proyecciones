<?php

namespace App\Imports;

use App\Models\alumnosMateriasModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class MateriaAlumnosImport implements ToModel,WithHeadingRow
{


    public function getCsvSettings(): array
    {
    return
        [
            'delimiter' => ","
        ];
    }

    public function model(array $row)
    {
        return new alumnosMateriasModel([


            'alumnos_id'    => $row['no_ctrol'],
            'materias_id'      => $row['materias'],


        ]);
    }


}
