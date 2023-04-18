<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/logo-icon2.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<title>KWS VMS</title>
</head>

<body class="bg-register">
	<!--wrapper-->

<main class="signup-form">
    <div class="container" style="padding-top: 80px;">
        <div class="row">
            <div class="col-md-4">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                <div class="card">
                    <h3 class="card-header">
                        Register User
                    </h3>
                    <div class="card-body">
                        <form action="{{ route('register.custom')}}" method="POST">
                        @csrf
                            <div class="form-field d-flex align-items-center">
                                <span class="fa fa-user"></span>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Full Name">
                                @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-field d-flex align-items-center">
                                <span class="fa fa-user"></span>
                                <input type="text" class="form-control" name="alias" id="alias" placeholder="User Name">
                                @if($errors->has('alias'))
                                <span class="text-danger">{{ $errors->first('alias')}}</span>
                                @endif
                            </div>
                            <div class="form-field d-flex align-items-center">
                                <span class="fa fa-user"></span>
                                <input type="text" name="email" class="form-control" placeholder="Email">
                                @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email')}}</span>
                                @endif
                            </div>
                            <div class="form-field d-flex align-items-center">
                                <span class="fa fa-user"></span>
                                <input type="text" class="form-control" name="role" id="role" placeholder="role">
                                @if($errors->has('role'))
                                <span class="text-danger">{{ $errors->first('role')}}</span>
                                @endif
                            </div>
                            <div class="form-field d-flex align-items-center">
                                <span class="fa fa-key"></span>
                                <input type="password" class="form-control" name="password" id="pwd" placeholder="Password">
                                @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password')}}</span>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Register</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

</main>
</body>

</html>