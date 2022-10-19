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
	<link href="assets/css/login.css" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<title>KWS VMS</title>
</head>

<body class="bg-login">
	<div class="container-fluid">
		<!--wrapper-->
        <div class="wrapper">
            <div class="logo">
                <img src="assets/images/logo-icon2.png" alt="">
            </div>
            <div class="text-center mt-4 name">
                Login
            </div>
            <div>
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
            <form method="post" class="p-3 mt-3" action="{{ route('login') }}">
                 @csrf
                <div class="form-field d-flex align-items-center">
                    <span class="fa fa-user"></span>
					<input type="email" class="form-control" id="inputEmailAddress" name="email" placeholder="Email">
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email')}}</span>
                    @endif
                </div>
                <div class="form-field d-flex align-items-center">
                    <span class="fa fa-key"></span>
                    <input type="password" name="password" id="pwd" placeholder="Password">
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn mt-3"><i class="bx bxs-lock-open"></i>Login</button>
            </form>
        </div>
    </div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function() {
			$("#show_hide_password a").on('click', function(event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>

</html>