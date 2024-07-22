<?php
session_start();

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php';</script>";
	exit;
}

include "../../koneksi/koneksi.php";

$sql = "SELECT MAX(RIGHT(no_reg, 3)) AS terakhir FROM tb_kunjungan";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);
$lastID = $data['terakhir'];
$lastNoUrut = (int) $lastID;
$nextNoUrut = $lastNoUrut + 1;
$nextID = "REG-" . sprintf("%03s", $nextNoUrut);

$sql_pasien = "SELECT kode_pasien, nama_pasien, jenis_kelamin, alamat FROM tb_pasien";
$result_pasien = mysqli_query($conn, $sql_pasien);
?>
<div class="container">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
						<b>Form</b> Tambah Data Pendaftaran Pasien
					</div>
					<form action="?page=pendaftaran-pasien&act=simpan" method="POST">
						<div class="form-group">
							<label>Janis Layanan</label>
							<select class="form-control" name="jenis_layanan">
								<option value="">Choose</option>
								<option value="umum">Umum</option>
								<option value="bpjs">BPJS</option>
							</select>
						</div>
						<div class="form-group">
							<label>No Registrasi</label>
							<input name="no_reg" type="text" value="<?= $nextID; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Tanggal Registrasi</label>
							<input type="date" class="form-control" name="tanggal_reg" value="<?= date('Y-m-d'); ?>" readonly>
						</div>
						<div class="form-group">
							<label>Unit Tujuan</label>
							<select class="form-control" name="unit_tujuan">
								<option value="">Choose</option>
								<option value="Poli Umum">Poli Umum</option>
								<option value="Poli Gigi">Poli Gigi</option>
								<option value="Poli KIA/KB">Poli KIA/KB</option>
								<option value="IGD">IGD</option>
							</select>
						</div>
						<div class="form-group">
							<label>Kode Pasien</label>
							<select class="form-control" name="kode_pasien" onchange="fillData(this.value)">
								<option value="">Choose</option>
								<?php while ($row_pasien = mysqli_fetch_array($result_pasien)) : ?>
									<option value="<?= $row_pasien['kode_pasien']; ?>"><?= $row_pasien['kode_pasien']; ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Nama Pasien</label>
							<input name="nama_pasien" id="nama_pasien" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<input name="jenis_kelamin" id="jenis_kelamin" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input name="alamat" id="alamat" type="text" class="form-control">
						</div>
						<div class="card-footer text-right">
							<button name="simpan" type="submit" class="btn btn-primary mr-1">Simpan</button>
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