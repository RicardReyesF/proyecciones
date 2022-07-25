@extends('platilla')
@section('content')

    <head>
        <!-- Custom styles for this template -->
        <link href="css/sb-admin-2.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">


    </head>

    <body>

        <div class="conteiner-fluid">
            <div class="card-columns">
                <div>
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Servicio Social</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div>
                                <canvas id="myChart" width="100" height="100"></canvas>
                            </div>
                            <hr>
                            Total de Alumnos : {{count($mujeres) + count($hombres)}}

                            <hr>
                            Alumnos que pueden realizar el Servicio Social.
                        </div>
                    </div>
                </div>

                <div>
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Residencia Profesional</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div>
                                <canvas id="myChart1" width="100" height="100"></canvas>
                            </div>
                            <hr>
                            Total de Alumnos : {{count($mujeresR) + count($hombresR)}}
                            <hr>
                            Alumnos que pueden realizar el Residencia Profesional.
                        </div>
                    </div>
                </div>
            </div>

        </div>




        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [
                        'Mujeres',
                        'Hombres',
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [{{ count($mujeres) }}, {{ count($hombres) }}],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',

                        ],
                        hoverOffset: 4
                    }]
                }
            });
        </script>
        <script>
            const ctx1 = document.getElementById('myChart1').getContext('2d');
            const myChart1 = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: [
                        'Mujeres',
                        'Hombres',
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [{{count($mujeresR)}}, {{count($hombresR)}}],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',

                        ],
                        hoverOffset: 4
                    }]
                }
            });
        </script>

    </body>
@endsection
