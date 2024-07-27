<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {

	include "../../koneksi/koneksi.php";
	/*pertama kita panggil colom yang akan kita gunakan untuk ID kita dengan menyaring nilai maksimum */
	$sql = "SELECT MAX(RIGHT(id_unitmedis,4)) AS terakhir FROM tb_unitmedis";
	//mengecek hasil atau value yang dihasilkan dari query yang disimpan pada variable sql
	$hasil = mysqli_query($conn, $sql);
	//memecah table hasil query
	$data = mysqli_fetch_array($hasil);
	//mengambil cell atau 1 kotak bagian dari table yaitu cell id_anggota yang dialiaskan terakhir
	$lastID = $data['terakhir'];
	// baca nomor urut  id transaksi terakhir
	$lastNoUrut = (int) $lastID;
	// nomor urut ditambah 1
	$nextNoUrut = $lastNoUrut + 1;
	// membuat format nomor berikutnya
	$nextID = "DOK" . sprintf("%04s", $nextNoUrut);
	// selesai,,, untuk memanggil ID otomatis ini  bisa memasangkan cara
?>
	<form action="?page=unit-medis&act=simpan" method="POST">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
							<b>Form</b> Tambah Data Unit Medis
						</div>
						<div class="form-group">
							<label>id Unit Medis</label>
							<input name="id_unitmedis" type="text" value="<?= $nextID; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Nama Unit Medis</label>
							<input name="nama_unitmedis" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Spesialis</label>
							<select class="form-control" name="spesialis">
								<option>Choose</option>
								<option>Dokter Umum</option>
								<option>Dokter Gigi dan Mulut</option>
								<option>Dokter Gizi</option>
								<option>Dokter Mata</option>
								<option>Dokter Kulit dan Kelamin</option>
								<option>Dokter Anstesi</option>
							</select>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input name="alamat" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>No. Telp</label>
							<input name="telpon" type="text" class="form-control">
						</div>
						<div class="card-footer text-right">
							<button name="simpan" type="submit" class="btn btn-primary mr-1">Simpan</button>
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