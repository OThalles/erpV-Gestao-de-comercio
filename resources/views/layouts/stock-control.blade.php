<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
</head>
<body>
    @section('menu')
    @show

    <main>
        @yield('content')
    </main>

    @section('footer')
    @show
</body>
</html>
