<?php
session_start();

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php';</script>";
	exit; // Menghentikan eksekusi lebih lanjut jika belum login
}

include "../../koneksi/koneksi.php";

// Periksa apakah ada parameter id pasien yang dikirimkan melalui URL
if (isset($_GET['no_reg'])) {
	$no_reg = $_GET['no_reg'];

	// Query untuk mengambil data pasien berdasarkan id atau no_reg (disesuaikan dengan struktur tabel)
	$sql_pasien = "SELECT * FROM tb_kunjungan WHERE no_reg = '$no_reg'";
	$result_pasien = mysqli_query($conn, $sql_pasien);

	// Periksa apakah data pasien ditemukan
	if (mysqli_num_rows($result_pasien) > 0) {
		$row_pasien = mysqli_fetch_assoc($result_pasien);

		// Data untuk mengisi form
		$no_reg = $row_pasien['no_reg'];
		$tgl_reg = $row_pasien['tgl_reg'];
		$unit_tujuan = $row_pasien['unit_tujuan'];
		$kode_pasien = $row_pasien['kode_pasien'];
		$nama_pasien = $row_pasien['nama_pasien'];
		$jenis_kelamin = $row_pasien['jenis_kelamin'];
		$alamat = $row_pasien['alamat'];
	} else {
		echo "<script>alert('Data pasien tidak ditemukan');</script>";
		echo "<script>window.location='?page=pendaftaran-pasien';</script>";
		exit;
	}
} else {
	echo "<script>alert('Parameter id tidak ditemukan');</script>";
	echo "<script>window.location='?page=pendaftaran-pasien';</script>";
	exit;
}
?>
<div class="container">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
						<b>Form</b> Edit Data Pendaftaran Pasien
					</div>
					<form action="?page=pendaftaran-pasien&act=simpan" method="POST">
						<div class="form-group">
							<label>No Registrasi</label>
							<input name="no_reg" type="text" value="<?= $no_reg; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Tanggal Registrasi</label>
							<input type="date" class="form-control" name="tanggal_reg" value="<?= $tgl_reg; ?>" readonly>
						</div>
						<div class="form-group">
							<label>Unit Tujuan</label>
							<select class="form-control" name="unit_tujuan">
								<option value="">Choose</option>
								<option value="Poli Umum" <?= ($unit_tujuan == 'Poli Umum') ? 'selected' : ''; ?>>Poli Umum</option>
								<option value="Poli Gigi" <?= ($unit_tujuan == 'Poli Gigi') ? 'selected' : ''; ?>>Poli Gigi</option>
								<option value="Poli KIA/KB" <?= ($unit_tujuan == 'Poli KIA/KB') ? 'selected' : ''; ?>>Poli KIA/KB</option>
								<option value="IGD" <?= ($unit_tujuan == 'IGD') ? 'selected' : ''; ?>>IGD</option>
							</select>
						</div>
						<div class="form-group">
							<label>Kode Pasien</label>
							<select class="form-control" name="kode_pasien" onchange="fillData(this.value)">
								<option value="">Choose</option>
								<?php
								mysqli_data_seek($result_pasien, 0);
								while ($row = mysqli_fetch_array($result_pasien)) {
									echo "<option value='" . $row['kode_pasien'] . "'";
									if ($row['kode_pasien'] == $kode_pasien) {
										echo " selected";
									}
									echo ">" . $row['kode_pasien'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Nama Pasien</label>
							<input name="nama_pasien" id="nama_pasien" type="text" class="form-control" value="<?= $nama_pasien; ?>">
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<input name="jenis_kelamin" id="jenis_kelamin" type="text" class="form-control" value="<?= $jenis_kelamin; ?>">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input name="alamat" id="alamat" type="text" class="form-control" value="<?= $alamat; ?>">
						</div>
						<div class="card-footer text-right">
							<button name="edit" type="submit" class="btn btn-primary mr-1">Simpan</button>
							<a href="?page=pendaftaran-pasien" class="btn btn-sm btn-warning" type="reset">Batal</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function fillData(kode_pasien) {
		<?php
		mysqli_data_seek($result_pasien, 0);
		while ($row_pasien = mysqli_fetch_array($result_pasien)) {
			echo "if (kode_pasien == '{$row_pasien['kode_pasien']}') {
                        document.getElementById('nama_pasien').value = '{$row_pasien['nama_pasien']}';
                        document.getElementById('jenis_kelamin').value = '{$row_pasien['jenis_kelamin']}';
                        document.getElementById('alamat').value = '{$row_pasien['alamat']}';
                    }";
		}
		?>
	}
</script>