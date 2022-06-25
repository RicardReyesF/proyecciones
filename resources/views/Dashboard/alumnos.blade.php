@extends('platilla')
@section('content')

<head>
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">


</head>

<body>
<div class="container-fluid">

    <div class="row">
        <form action="{{ route ('Importar')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div style="text-align:end">
                <input type="file" name="documento">
            </div>

            <div style="text-align:end">
                <button class="button button1 font-weigth-bold" type="submit">Exportar</button>
            </div>
        </form>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ALUMNOS</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>No de control</th>
                            <th>Semestre</th>
                            <th>Creditos plan de estudio</th>
                            <th>Creditos acumulados</th>
                            <th>Creditos que debe de tener</th>
                            <th>Promedio</th>
                            <th>Materias</th>
                            <th>Proyeccion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos as $alumno )
                            <tr>
                                <td>{{ $alumno->nombre}}</td>
                                <td>{{ $alumno->noControl }}</td>
                                <td>{{ $alumno->semestre }}</td>
                                <td>{{ $alumno->creditosPlan }}</td>
                                <td>{{ $alumno->creditosA }}</td>
                                <td>{{ $alumno->creditosQueDebeTener }}</td>
                                <td>{{ $alumno->promedio }}</td>
                                <td>
                                    <a type="button" class="btn btn-success" href="{{route('Materias',$alumno->noControl)}}" >Materias</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary">Proyeccion</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    $.noConflict();
    $('#dataTable').DataTable();
});
</script>

</body>

@endsection
