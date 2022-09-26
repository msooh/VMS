<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Management System</title>

    <script src="{{ asset('/javascript/jquery-3.6.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/Fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('/Fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('/Fontawesome/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}" class="stylesheet">
    @stack('css')
    
</head>
<body>
        <nav class="navbar navbar-expand-sm navbar-transparent">
            <div class="container-fluid">
                <img src="{{ asset('images/logo.png') }}" style="float:left; height: 60px; color: white;">
              <a class="navbar-brand float-start" href="#">Visitor Management</a>
            </div>
          </nav>
        <div class="container-fluid dashboard">
          @yield('content')
        </div>
        
    <script src="{{ asset ('/js/bootstrap.min.js') }}"></script>
</body>
</html>