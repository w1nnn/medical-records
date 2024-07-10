<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen');
					window.location = '../../index.php'</script>";
} else {

?>
	<?php
	// Jika melakukan edit, ambil data pasien berdasarkan kode_pasien
	if (isset($_GET['kode_pasien'])) {
		$kode_pasien = $_GET['kode_pasien'];
		$sql_select = "SELECT * FROM tb_pasien WHERE kode_pasien = '$kode_pasien'";
		$hasil = mysqli_query($conn, $sql_select);
		$data = mysqli_fetch_assoc($hasil);
	} else {
		// Jika tidak ada kode_pasien yang diterima, redirect atau lakukan sesuai kebutuhan
		echo "<script>window.location='?page=pasien';</script>";
		exit;
	}
	?>
	<!-- Form untuk edit data pasien -->
	<form action="?page=pasien&act=simpan" method="POST">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="alert alert-info">
							<b>Form</b> Edit Data Pasien
						</div>
						<div class="form-group">
							<label>Kode Pasien</label>
							<input name="kode_pasien" type="text" value="<?= $data['kode_pasien']; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Nama Pasien</label>
							<input name="nama_pasien" type="text" value="<?= $data['nama_pasien']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input name="tanggal_lahir" type="date" value="<?= $data['tanggal_lahir']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select class="form-control" name="jenis_kelamin">
								<option>Choose</option>
								<option <?= ($data['jenis_kelamin'] == 'Laki Laki') ? 'selected' : ''; ?>>Laki Laki</option>
								<option <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input name="alamat" type="text" value="<?= $data['alamat']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Pekerjaan</label>
							<input name="pekerjaan" type="text" value="<?= $data['pekerjaan']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>No. Telp</label>
							<input name="telpon" type="text" value="<?= $data['telpon']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input name="email" type="text" value="<?= $data['email']; ?>" class="form-control">
						</div>
						<div class="card-footer text-right">
							<button name="edit" type="submit" class="btn btn-primary mr-1">Simpan</button>
							<a href="?page=pasien" class="btn btn-sm btn-warning" type="reset">Batal</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

<?php
}
?>