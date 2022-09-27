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
    @guest
    @yield('content')
    @else
        <nav class="navbar navbar-expand-sm navbar-transparent">
            <div class="container-fluid">
                <img src="{{ asset('images/logo.png') }}" style="float:left; height: 60px; color: white;">
              <a class="navbar-brand" href="#">Visitor Management</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="nav navbar-nav ms-auto">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">How'd {{Auth::user()->name}}</a>
                    <ul class="dropdown-menu">
                      <li class="dropdown-item">
                        <div class="navbar-content">
                            <span>{{Auth::user()->name}}</span>
                            <p class="text-muted small">
                            {{Auth::user()->email}}
                            </p>
                            <div class="divider">
                            </div>
                            <li><a href="{{ route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Logout</span></a></li>
                        </div>
                    </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        <div class="container-fluid dashboard">   
        <div class="row dashboard-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="navi">
                    <ul>
                        <li class="active"><a href="/visitors"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Visitors</span></a></li>
                        <li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Appointments</span></a></li>
                        <li><a href="#"><i class="fa fa-file" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Reports</span></a></li>
                        <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Setting</span></a></li>
                    </ul>
                </div>
            </div>
             <div class="col-md-10 col-sm-11 display-table-cell v-align">
             @yield('content')
             </div>
        </div>

    </div>
    @endguest
    <script src="{{ asset ('/js/bootstrap.min.js') }}"></script>
</body>
</html>