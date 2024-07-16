<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {
	include "../../koneksi/koneksi.php";

	// Jika melakukan edit, ambil data pasien berdasarkan kode_pasien
	if (isset($_GET['id_unitmedis'])) {
		$id_unitmedis = $_GET['id_unitmedis'];
		$sql_select = "SELECT * FROM tb_unitmedis WHERE id_unitmedis = '$id_unitmedis'";
		$hasil = mysqli_query($conn, $sql_select);
		$data = mysqli_fetch_assoc($hasil);

		// Jika data tidak ditemukan, redirect
		if (!$data) {
			echo "<script>alert('Data tidak ditemukan'); window.location='?page=unit-medis';</script>";
			exit;
		}
	} else {
		// Jika tidak ada id_unitmedis yang diterima, redirect atau lakukan sesuai kebutuhan
		echo "<script>window.location='?page=unit-medis';</script>";
		exit;
	}
?>

	<form action="?page=unit-medis&act=simpan" method="POST">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
							<b>Form</b> Edit Data Pasien
						</div>
						<div class="form-group">
							<label>id Unit Medis</label>
							<input name="id_unitmedis" type="text" value="<?= $data['id_unitmedis']; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Nama Unit Medis</label>
							<input name="nama_unitmedis" type="text" value="<?= $data['nama_unitmedis']; ?>" class="form-control" onclick="document.getElementById('main-content').classList.add('blur-background')" onblur="document.getElementById('main-content').classList.remove('blur-background')">
						</div>
						<div class="form-group">
							<label>Spesialis</label>
							<select class="form-control" name="spesialis" onclick="document.getElementById('main-content').classList.add('blur-background')" onblur="document.getElementById('main-content').classList.remove('blur-background')">
								<option value="Dokter Umum" <?= $data['spesialis'] == 'Dokter Umum' ? 'selected' : ''; ?>>Dokter Umum</option>
								<option value="Dokter Gigi dan Mulut" <?= $data['spesialis'] == 'Dokter Gigi dan Mulut' ? 'selected' : ''; ?>>Dokter Gigi dan Mulut</option>
								<option value="Dokter Gizi" <?= $data['spesialis'] == 'Dokter Gizi' ? 'selected' : ''; ?>>Dokter Gizi</option>
								<option value="Dokter Mata" <?= $data['spesialis'] == 'Dokter Mata' ? 'selected' : ''; ?>>Dokter Mata</option>
								<option value="Dokter Kulit dan Kelamin" <?= $data['spesialis'] == 'Dokter Kulit dan Kelamin' ? 'selected' : ''; ?>>Dokter Kulit dan Kelamin</option>
								<option value="Dokter Anstesi" <?= $data['spesialis'] == 'Dokter Anstesi' ? 'selected' : ''; ?>>Dokter Anstesi</option>
							</select>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input name="alamat" type="text" value="<?= $data['alamat']; ?>" class="form-control" onclick="document.getElementById('main-content').classList.add('blur-background')" onblur="document.getElementById('main-content').classList.remove('blur-background')">
						</div>
						<div class="form-group">
							<label>No. Telp</label>
							<input name="telpon" type="text" value="<?= $data['telpon']; ?>" class="form-control" onclick="document.getElementById('main-content').classList.add('blur-background')" onblur="document.getElementById('main-content').classList.remove('blur-background')">
						</div>
						<div class="card-footer text-right">
							<button name="edit" type="submit" class="btn btn-primary mr-1">Simpan</button>
							<a href="?page=unit-medis" class="btn btn-sm btn-warning" type="reset">Batal</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php
}
?>