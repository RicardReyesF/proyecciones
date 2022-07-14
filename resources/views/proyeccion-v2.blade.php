<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<div class="container-fluid pt-3">
    <div class="row justify-content-center">
        @foreach($semestres as $semestre)
            <div class="col-auto border">
                <ul>
                    @foreach($semestre as $materia)
                        <li>{{ $materia->nombre ?? '' }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
