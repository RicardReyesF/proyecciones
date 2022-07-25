@extends('platilla')
@section('content')


<head>
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

</head>

<body>
    <div class="conteiner-fluid">
        <div class="card-columns">
            @foreach ($semestres as $semestre)
                <div class="cardT {{ $alumno->semestre + $loop->index > 12 ? 'bg-danger' : 'bg-success' }}">
                    <h6 class="text-center">
                        Semestre {{ $alumno->semestre + $loop->index }}
                    </h6>
                    <hr>
                    @foreach($semestre as $materia)
                            <li>{{ $materia->nombre ?? '' }}</li>

                    @endforeach
                    <h6 class="text-center">
                        Creditos: {{$semestre->sum('creditos')}}
                    </h6>

                </div>
            @endforeach
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
</body>


@endsection
