	<?php
	session_start();
	include "../koneksi/koneksi.php";
	if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
		echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen');
						window.location = '../index.php'</script>";
	} else {
		$userName = $_SESSION['username'];
		$foto = $_SESSION['foto'];
		$nama = $_SESSION['nama'];
		$password = $_SESSION['password'];


	?>
		<!DOCTYPE html>
		<html lang="en">

		<head>
			<meta charset="UTF-8">
			<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
			<title>Admin Dashboard</title>

			<!-- General CSS Files -->
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

			<!-- CSS Libraries -->
			<link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
			<link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css">
			<link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
			<link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">
			<link rel="stylesheet" href="../node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
			<link rel="stylesheet" href="../node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
			<!-- Template CSS -->
			<link rel="stylesheet" href="../assets/css/style.css">
			<link rel="stylesheet" href="../assets/css/select2.css">
			<link rel="stylesheet" href="../assets/css/components.css">
			<!-- Boostrap Icon node modules -->
			<link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">


		</head>

		<body>
			<div id="app">
				<div class="main-wrapper">
					<div class="navbar-bg" style="background-color: #0093E9; background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);"></div>
					<nav class="navbar navbar-expand-lg main-navbar">
						<form class="form-inline mr-auto">
							<ul class="navbar-nav mr-3">
								<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
								<li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
							</ul>
							<div class="search-element">
								<input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" style="border-radius:  0 0 0 20px;">
								<button class="btn" type="submit" style="border-radius: 0 20px 0 0;"><i class="fas fa-search"></i></button>
								<div class="search-backdrop"></div>
								<div class="search-result">
									<div class="search-header">
										Histories
									</div>
									<div class="search-item">
										<a href="#">How to hack NASA using CSS</a>
										<a href="#" class="search-close"><i class="fas fa-times"></i></a>
									</div>
									<div class="search-item">
										<a href="#">Kodinger.com</a>
										<a href="#" class="search-close"><i class="fas fa-times"></i></a>
									</div>
									<div class="search-item">
										<a href="#">#Stisla</a>
										<a href="#" class="search-close"><i class="fas fa-times"></i></a>
									</div>
									<div class="search-header">
										Result
									</div>
									<div class="search-item">
										<a href="#">
											<img class="mr-3 rounded" width="30" src="../assets/img/products/product-3-50.png" alt="product">
											oPhone S9 Limited Edition
										</a>
									</div>
									<div class="search-item">
										<a href="#">
											<img class="mr-3 rounded" width="30" src="../assets/img/products/product-2-50.png" alt="product">
											Drone X2 New Gen-7
										</a>
									</div>
									<div class="search-item">
										<a href="#">
											<img class="mr-3 rounded" width="30" src="../assets/img/products/product-1-50.png" alt="product">
											Headphone Blitz
										</a>
									</div>
									<div class="search-header">
										Projects
									</div>
									<div class="search-item">
										<a href="#">
											<div class="search-icon bg-danger text-white mr-3">
												<i class="fas fa-code"></i>
											</div>
											Stisla Admin Template
										</a>
									</div>
									<div class="search-item">
										<a href="#">
											<div class="search-icon bg-primary text-white mr-3">
												<i class="fas fa-laptop"></i>
											</div>
											Create a new Homepage Design
										</a>
									</div>
								</div>
							</div>
						</form>
						<ul class="navbar-nav navbar-right">
							<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
								<div class="dropdown-menu dropdown-list dropdown-menu-right">
									<div class="dropdown-header">Messages
										<div class="float-right">
											<a href="#">Mark All As Read</a>
										</div>
									</div>
									<div class="dropdown-list-content dropdown-list-message">
										<a href="#" class="dropdown-item dropdown-item-unread">
											<div class="dropdown-item-avatar">
												<img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle">
												<div class="is-online"></div>
											</div>
											<div class="dropdown-item-desc">
												<b>Kusnaedi</b>
												<p>Hello, Bro!</p>
												<div class="time">10 Hours Ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item dropdown-item-unread">
											<div class="dropdown-item-avatar">
												<img alt="image" src="../assets/img/avatar/avatar-2.png" class="rounded-circle">
											</div>
											<div class="dropdown-item-desc">
												<b>Dedik Sugiharto</b>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
												<div class="time">12 Hours Ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item dropdown-item-unread">
											<div class="dropdown-item-avatar">
												<img alt="image" src="../assets/img/avatar/avatar-3.png" class="rounded-circle">
												<div class="is-online"></div>
											</div>
											<div class="dropdown-item-desc">
												<b>Agung Ardiansyah</b>
												<p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
												<div class="time">12 Hours Ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="dropdown-item-avatar">
												<img alt="image" src="../assets/img/avatar/avatar-4.png" class="rounded-circle">
											</div>
											<div class="dropdown-item-desc">
												<b>Ardian Rahardiansyah</b>
												<p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
												<div class="time">16 Hours Ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="dropdown-item-avatar">
												<img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle">
											</div>
											<div class="dropdown-item-desc">
												<b>Alfa Zulkarnain</b>
												<p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
												<div class="time">Yesterday</div>
											</div>
										</a>
									</div>
									<div class="dropdown-footer text-center">
										<a href="#">View All <i class="fas fa-chevron-right"></i></a>
									</div>
								</div>
							</li>
							<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
								<div class="dropdown-menu dropdown-list dropdown-menu-right">
									<div class="dropdown-header">Notifications
										<div class="float-right">
											<a href="#">Mark All As Read</a>
										</div>
									</div>
									<div class="dropdown-list-content dropdown-list-icons">
										<a href="#" class="dropdown-item dropdown-item-unread">
											<div class="dropdown-item-icon bg-primary text-white">
												<i class="fas fa-code"></i>
											</div>
											<div class="dropdown-item-desc">
												Template update is available now!
												<div class="time text-primary">2 Min Ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="dropdown-item-icon bg-info text-white">
												<i class="far fa-user"></i>
											</div>
											<div class="dropdown-item-desc">
												<b>You</b> and <b>Dedik Sugiharto</b> are now friends
												<div class="time">10 Hours Ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="dropdown-item-icon bg-success text-white">
												<i class="fas fa-check"></i>
											</div>
											<div class="dropdown-item-desc">
												<b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
												<div class="time">12 Hours Ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="dropdown-item-icon bg-danger text-white">
												<i class="fas fa-exclamation-triangle"></i>
											</div>
											<div class="dropdown-item-desc">
												Low disk space. Let's clean it!
												<div class="time">17 Hours Ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="dropdown-item-icon bg-info text-white">
												<i class="fas fa-bell"></i>
											</div>
											<div class="dropdown-item-desc">
												Welcome to Stisla template!
												<div class="time">Yesterday</div>
											</div>
										</a>
									</div>
									<div class="dropdown-footer text-center">
										<a href="#">View All <i class="fas fa-chevron-right"></i></a>
									</div>
								</div>
							</li>
							<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
									<img alt="image" src="../assets/upload/<?= $foto; ?>" class="rounded-circle mr-1" style="height: 30px; width: 30px;">
									<div class="d-sm-none d-lg-inline-block">Hi, <?= $nama; ?></div>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<div class="dropdown-title">Logged in 5 min ago</div>
									<a href="" class="dropdown-item has-icon" id="modal-5">
										<i class="far fa-user"></i> Profile
									</a>
									<div class="dropdown-divider"></div>
									<a href="../logout.php" id="toastr-2" class="dropdown-item has-icon text-danger">
										<i class="fas fa-sign-out-alt"></i> Logout
									</a>
								</div>
							</li>
						</ul>
					</nav>
					<div class="main-sidebar sidebar-style-2">
						<aside id="sidebar-wrapper">
							<div class="sidebar-brand my-4">
								<img src="../assets/img/logo.png" alt="" style="width: 37px;">
								<b>KONDODEWATA</b>
								<p style="margin-top: -28px; margin-right: 22px; font-style: italic; font-size: 10px;">Tana Toraja</p>
							</div>
							<div class="sidebar-brand sidebar-brand-sm">
								<a href="index.html">St</a>
							</div>
							<ul class="sidebar-menu">
								<li><a class="nav-link" href="dashboard.php"><i class="bi bi-grid-1x2-fill mt-1"></i> <span>Dashboard</span></a></li>
								<li class="menu-header"></li>
								<li class="nav-item dropdown">
									<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="bi bi-stack mt-1"></i> <span>Master</span></a>
									<ul class="dropdown-menu">
										<li><a class="nav-link" href="?page=pasien">Data Pasien</a></li>
										<!-- <li><a class="nav-link" href="?page=pegawai">Data Pegawai</a></li> -->
										<li><a class="nav-link" href="?page=unit-medis">Data Unit Medis</a></li>
										<li><a class="nav-link" href="?page=obat">Data Obat</a></li>
									</ul>
								</li>
								<li><a class="nav-link" href="?page=pendaftaran-pasien"><i class="bi bi-clipboard-plus-fill mt-1"></i> <span>Pendaftaran Berobat</span></a></li>
								<li><a class="nav-link" href="?page=resep-dokter"><i class="bi bi-person-fill-check mt-1"></i> <span>Resep Dokter</span></a></li>
								<li><a class="nav-link" href="?page=rekam-medis"><i class="bi bi-pencil-square mt-1"></i> <span>Rekam Medis</span></a></li>
								<li><a class="nav-link" href="?page=transaksi"><i class="bi bi-cart-check-fill mt-1"></i> <span>Transaksi</span></a></li>
								<li class="menu-header"></li>
								<li class="nav-item dropdown">
									<a href="#" class="nav-link has-dropdown" ata-toggle="dropdown"><i class="fas fa-th"></i> <span>Laporan</span></a>
									<ul class="dropdown-menu">
										<li><a class="nav-link" href="bootstrap-alert.html">Laporan Kunjungan</a></li>
										<li><a class="nav-link" href="bootstrap-badge.html">Laporan Pasien</a></li>

									</ul>
								</li>
								<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
									<a href="../logout.php" class="btn btn-lg btn-block btn-icon-split" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%); color: #fff;">
										<i class="fas fa-sign-out-alt"></i> Logout
									</a>
								</div>
						</aside>
					</div>

					<!-- Main Content -->
					<div class="main-content">
						<section class="section">
							<div class="section-header">
								<h1>Sistem Informasi Rekam Medis</h1>
							</div>
							<div class="section-body">
								<?php
								error_reporting(0);
								$page = isset($_GET['page']) ? $_GET['page'] : '';
								$act = isset($_GET['act']) ? $_GET['act'] : '';

								if ($page == 'pasien') {
									if ($act == '') {
										include '../hal/pasien/data-pasien.php';
									} else if ($act == 'add') {
										include '../hal/pasien/input-pasien.php';
									} else if ($act == 'edit') {
										include '../hal/pasien/edit-data.php';
									} else if ($act == 'hapus') {
										include '../hal/pasien/proses-hapus.php';
									} else if ($act == 'simpan') {
										include '../hal/pasien/proses-simpan.php';
									}
								} else if ($page == 'pegawai') {
									if ($act == '') {
										include '../hal/pegawai/data-pegawai.php';
									} else if ($act == 'tambah') {
										include '../pegawai/tambah.php';
									} else if ($act == 'edit') {
										include '../pegawai/edit.php';
									} else if ($act == 'hapus') {
										include '../pegawai/hapus.php';
									}
								} else if ($page == 'unit-medis') {
									if ($act == '') {
										include '../hal/unitmedis/data-unitmedis.php';
									} else if ($act == 'add') {
										include '../hal/unitmedis/input-unitmedis.php';
									} else if ($act == 'edit') {
										include '../hal/unitmedis/edit-data.php';
									} else if ($act == 'del') {
										include '../hal/unitmedis/proses-hapus.php';
									} else if ($act == 'simpan') {
										include '../hal/unitmedis/proses-simpan.php';
									}
								} else if ($page == 'obat') {
									if ($act == '') {
										include '../hal/obat/data-obat.php';
									} else if ($act == 'tambah') {
										include '../hal/obat/input-obat.php';
									} else if ($act == 'edit') {
										include '../hal/obat/edit-data.php';
									} else if ($act == 'del') {
										include '../hal/obat/proses-hapus.php';
									} else if ($act == 'simpan') {
										include '../hal/obat/proses-simpan.php';
									} else if ($act == 'fetch') {
										include '../hal/obat/api-obat.php';
									}
								} else if ($page == 'pendaftaran-pasien') {
									if ($act == '') {
										include '../hal/kunjungan/data-kunjungan.php';
									} else if ($act == 'add') {
										include '../hal/kunjungan/input-kunjungan.php';
									} else if ($act == 'edit') {
										include '../hal/kunjungan/edit-data.php';
									} else if ($act == 'hapus') {
										include '../hal/kunjungan/proses-hapus.php';
									} else if ($act == 'simpan') {
										include '../hal/kunjungan/proses-simpan.php';
									} else if ($act == 'cetak') {
										include '../hal/kunjungan/cetak_kartu.php';
									}
								} else if ($page == 'resep-dokter') {
									if ($act == '') {
										include '../hal/resep/data-resep.php';
									} else if ($act == 'add') {
										include '../hal/resep/input-resep.php';
									} else if ($act == 'edit') {
										include '../resep/edit.php';
									} else if ($act == 'hapus') {
										include '../resep/hapus.php';
									} else if ($act == 'simpan') {
										include '../hal/resep/proses-simpan.php';
									} else if ($act == 'tambah') {
										include '../hal/resep/proses-tambah.php';
									} else if ($act == 'detail') {
										include '../hal/resep/detail.php';
									}
								} else if ($page == 'rekam-medis') {
									if ($act == '') {
										include '../hal/rekammedis/data-rekmed.php';
									} else if ($act == 'add') {
										include '../hal/rekammedis/input-rekmed.php';
									} else if ($act == 'edit') {
										include '../hal/rekammedis/edit-data.php';
									} else if ($act == 'del') {
										include '../hal/rekammedis/proses-hapus.php';
									} else if ($act == 'simpan') {
										include '../hal/rekammedis/proses-simpan.php';
									}
								} else if ($page == 'transaksi') {
									if ($act == '') {
										include '../hal/kwitansi/data-kwitansi.php';
									} else if ($act == 'add') {
										include '../hal/kwitansi/input-kwitansi.php';
									} else if ($act == 'edit') {
										include '../hal/kwitansi/edit.php';
									} else if ($act == 'del') {
										include '../hal/kwitansi/proses-hapus.php';
									} else if ($act == 'save') {
										include '../hal/kwitansi/proses-simpan.php';
									} else if ($act == 'pay') {
										include '../hal/kwitansi/bayar.php';
									}
								} else if ($page == 'checkout') {
									if ($act == '') {
										include '../hal/kwitansi/req.php';
									}
								} else {
									include '../hal/home.php';
								}
								?>

							</div>
						</section>
					</div>

				</div>
			</div>

			<!-- Modal Profile -->
			<form class="modal-part" id="modal-login-part">
				<div class="form-group">
					<label>Username</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<i class="fas fa-envelope"></i>
							</div>
						</div>
						<input value="<?= $userName; ?>" type="text" class="form-control" placeholder="Username" name="username">
					</div>
				</div>
				<div class="form-group">
					<label>Nama Pengguna</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<i class="fas fa-lock"></i>
							</div>
						</div>
						<input value="<?= $nama; ?>" type="text" class="form-control" placeholder="Nama Pengguna" name="nama">
					</div>
				</div>
				<div class="form-group">
					<label>Password</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<i class="fas fa-lock"></i>
							</div>
						</div>
						<input value="<?= $password; ?>" type="password" class="form-control" placeholder="Password" name="password">
					</div>
				</div>
			</form>

			</div>

			<!-- General JS Scripts -->
			<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
			<script src="../assets/js/stisla.js"></script>

			<!-- JS Libraies -->
			<script src="../node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
			<script src="../node_modules/chart.js/dist/Chart.min.js"></script>
			<script src="../node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
			<script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
			<script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
			<script src="../node_modules/jquery-ui-dist/jquery-ui.min.js"></script>

			<!-- Template JS File -->
			<script src="../assets/js/scripts.js"></script>
			<script src="../assets/js/custom.js"></script>
			<script src="../assets/js/page/bootstrap-modal.js"></script>
			<script src="../node_modules/izitoast/dist/js/iziToast.min.js"></script>

			<script src="../assets/js/page/index.js"></script>
			<script src="../assets/js/page/components-table.js"></script>

			<script src="../node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
			<script src="../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
			<script src="../node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
			<script src="../assets/js/page/modules-datatables.js"></script>
			<script src="../assets/js/select2.js"></script>

		</body>

		</html>
	<?php
	}
	?>