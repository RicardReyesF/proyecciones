<?php

namespace App\Imports;

use App\Models\Alumno;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class AlumnosImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Alumno([

            'carrera'      => $row['nombre'],
            'noControl'    => $row['no_ctrol'],
            'nombre'       => $row['nombre_alumno'],
            'planDeEstudio'      => $row['plan_id'],
            'semestre'      => $row['semestre'],
            'estatus'      => $row['estatus_actual'],
            'genero'        => $row['genero'],
            'creditosPlan'      => $row['creditos_del_plan_de_estudios'],
            'creditosA'      => $row['credito_acumulados'],
            'creditosQueDebeTener'      => $row['creditos_que_deberia_tener'],
            'promedio'      => $row['promedio_general'],

        ]);
    }

    public function batchSize(): int
    {
        return 4000;
    }

    public function chunkSize(): int
    {
        return 4000;
    }


}
