@extends('platilla')
@section('content')


<head>
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <div class="conteiner-fluid">
            @foreach ($arregloMaterias as $materia)
            <div class="cardT">
                <h1>Materias</h1>
                <p>{{$materia['nombre']}}</p>
            </div>
            @endforeach
    </div>
    <!---
    <svg width="400" height="180">
      <rect x="100" y="35" rx="35" ry="35" width="120" height="120" style="fill:white;stroke:black;stroke-width:1.0;opacity:0.5" />
        <text font-size="10" font-family="arial" x="100" y="100">$materia</text>
    </svg>
-->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
</body>


@endsection
