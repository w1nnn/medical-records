<?php
session_start();
include "koneksi/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Login</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="./node_modules/bootstrap-social/bootstrap-social.css">
	<link rel="stylesheet" href="./node_modules/izitoast/dist/css/iziToast.min.css">
	<!-- Template CSS -->
	<link rel="stylesheet" href="./assets/css/style.css">
	<link rel="stylesheet" href="./assets/css/components.css">
</head>

<body>
	<div id="app">
		<section class="section">
			<div class="d-flex flex-wrap align-items-stretch">
				<div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
					<div class="p-4 m-3">
						<img src="./assets/img/stisla-fill.svg" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
						<h4 class="text-dark font-weight-normal">Log<span class="font-weight-bold">in</span></h4>
						<!-- <p class="text-muted">Before you get started, you must login or register if you don't already have an account.</p> -->
						<form method="POST" action="" class="needs-validation" novalidate="">
							<div class="form-group">
								<label for="username">Username</label>
								<input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
								<div class="invalid-feedback">
									Please fill in your email
								</div>
							</div>

							<div class="form-group">
								<div class="d-block">
									<label for="password" class="control-label">Password</label>
								</div>
								<input id="password" type="password" class="form-control" name="password" tabindex="2" required>
								<div class="invalid-feedback">
									please fill in your password
								</div>
							</div>

							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
									<label class="custom-control-label" for="remember-me">Remember Me</label>
								</div>
							</div>

							<div class="form-group text-right">
								<a href="auth-forgot-password.html" class="float-left mt-3">
									Forgot Password?
								</a>
								<button type="submit" name="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
									Login
								</button>
							</div>

							<div class="mt-5 text-center">
								Don't have an account? <a href="auth-register.html">Create new one</a>
							</div>
						</form>

						<div class="text-center mt-5 text-small">
							Copyright &copy; Upana Studio. Made with ðŸ’™ by erwin
							<div class="mt-2">
								<a href="#">Privacy Policy</a>
								<div class="bullet"></div>
								<a href="#">Terms of Service</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="./assets/img/unsplash/login-bg.jpg">
					<div class="absolute-bottom-left index-2">
						<div class="text-light p-5 pb-2">
							<div class="mb-5 pb-3">
								<h1 class="mb-2 display-4 font-weight-bold">Sistem Informasi Rekam Medis</h1>
								<h5 class="font-weight-normal text-muted-transparent">Puskesmas Kondo Dewata, Tana Toraja</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- General JS Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="../assets/js/stisla.js"></script>

	<!-- JS Libraies -->

	<!-- Template JS File -->
	<script src="./assets/js/scripts.js"></script>
	<script src="./assets/js/custom.js"></script>
	<script src="./node_modules/izitoast/dist/js/iziToast.min.js"></script>
	<!-- Page Specific JS File -->
</body>

</html>


<?php
// $login = mysqli_query($conn, "SELECT * FROM tb_login WHERE username = '$username' AND password = '$pass'");
// $ketemu = mysqli_num_rows($login);
// $r = mysqli_fetch_array($login);
// var_dump($r);

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$pass     = $_POST['password'];

	// Perhatikan penggunaan mysqli_* untuk koneksi dan query
	$login = mysqli_query($conn, "SELECT * FROM tb_login WHERE username = '$username' AND password = '$pass'");
	$ketemu = mysqli_num_rows($login);
	$r = mysqli_fetch_array($login);

	// Apabila username dan password ditemukan
	if ($ketemu > 0) {

		$_SESSION['username'] = $r['username'];
		$_SESSION['password'] = $r['password'];
		$_SESSION['nama'] = $r['nama'];
		$_SESSION['level'] = $r['level'];
		$_SESSION['foto'] = $r['foto'];
		$nama = $_SESSION['nama'];
		echo "<script>
        iziToast.success({
            title: 'Selamat Datang',
            message: '$nama',
            position: 'topRight'
          });
          setTimeout(function(){
            window.location.href = 'hal/index.php';
          }, 2000);
        </script>";
	} else if (empty($username) || empty($pass)) {
		echo "<script>
        iziToast.warning({
            title: 'Maaf',
            message: 'Username atau Password Tidak Boleh Kosong!',
            position: 'topRight'
          });
        </script>";
	} else {
		echo "<script>
        iziToast.warning({
            title: 'Maaf',
            message: 'Username atau Password Salah!',
            position: 'topRight'
          });
        </script>";
	}
}
