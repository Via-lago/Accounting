<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        table.tabel-info{
            width: 100%;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        table.tabel-info, table.tabel-info td, table.tabel-info th{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 1px;
        }
        table.tabel-info td{
            padding: 2px;
        }
        .total{
            text-align: left;
        }
        header{
            text-align: center;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <header>
        <h1>{{ App\Instansi::first()->nama }}</h1>
        <p>{{ App\Instansi::first()->alamat }}</p>
        <hr>
    </header>
    @yield('content')
</body>
</html>
