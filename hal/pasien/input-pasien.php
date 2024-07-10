<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {

	include "../../koneksi/koneksi.php";
	/*pertama kita panggil colom yang akan kita gunakan untuk ID kita dengan menyaring nilai maksimum */
	$sql = "SELECT MAX(RIGHT(kode_pasien,4)) AS terakhir FROM tb_pasien";
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
	$nextID = "PSN" . sprintf("%04s", $nextNoUrut);
	// selesai,,, untuk memanggil ID otomatis ini  bisa memasangkan cara
?>
	<form action="?page=pasien&act=simpan" method="POST">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="alert alert-info">
							<b>Form</b> Tambah Data Pasien
						</div>
						<div class="form-group">
							<label>Kode Pasien</label>
							<input name="kode_pasien" type="text" value="<?= $nextID; ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Nama Pasien</label>
							<input name="nama_pasien" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="date" class="form-control" name="tanggal_lahir">
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select class="form-control" name="jenis_kelamin">
								<option>Choose</option>
								<option>Laki Laki</option>
								<option>Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input name="alamat" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Pekerjaan</label>
							<input name="pekerjaan" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>No. Telp</label>
							<input name="telpon" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input name="email" type="text" class="form-control">
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