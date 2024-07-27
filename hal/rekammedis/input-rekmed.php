<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen');
            window.location = '../../index.php'</script>";
} else {
?>

	<form action="?page=rekam-medis&act=simpan" method="POST">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
							<b>Form</b> Tambah Data Rekam Medis
						</div>
						<?php
						include "../../koneksi/koneksi.php";
						$sql = "SELECT MAX(RIGHT(no_rekmed,4)) AS terakhir FROM tb_rekmed";
						$hasil = mysqli_query($conn, $sql);
						$data = mysqli_fetch_array($hasil);
						$lastID = $data['terakhir'];
						$lastNoUrut = (int) $lastID;
						$nextNoUrut = $lastNoUrut + 1;
						$nextID = "RM-" . sprintf("%04s", $nextNoUrut);
						?>
						<div class="form-group">
							<label for="no_rekmed"><b>No. Rekam Medis</b></label>
							<input name="no_roso" type="text" class="form-control" value="<?php echo  $nextID; ?>" disabled>
							<input name="no_rekmed" type="hidden" value="<?php echo  $nextID; ?>">
						</div>
						<?php
						date_default_timezone_set('Asia/Jakarta');
						$tanggal = mktime(date("m"), date("d"), date("Y"));
						$tglsekarang = date("Y-m-d", $tanggal);
						?>

						<div class="form-group">
							<label for="kode_pasien">Kode Pasien</label>
							<select name="kode_pasien" id="kode_pasien" class="form-control" onchange="changeValue(this.value)">
								<option value=0>-Pilih-</option>
								<?php
								$result = mysqli_query($conn, "SELECT * FROM tb_pasien");
								$jsArray = "var dt_pasien = new Array();\n";
								while ($row = mysqli_fetch_array($result)) {
									echo '<option value="' . $row['kode_pasien'] . '">' . $row['kode_pasien'] . '</option>';
									$jsArray .= "dt_pasien['" . $row['kode_pasien'] . "'] = {nama_pasien:'" . addslashes($row['nama_pasien']) . "',jenis_kelamin:'" . addslashes($row['jenis_kelamin']) . "',alamat:'" . addslashes($row['alamat']) . "'};\n";
								}
								?>
							</select>
						</div>
						<script type="text/javascript">
							<?php echo $jsArray; ?>

							function changeValue(kode_pasien) {
								document.getElementById('nama_pasien').value = dt_pasien[kode_pasien].nama_pasien;
								document.getElementById('jenis_kelamin').value = dt_pasien[kode_pasien].jenis_kelamin;
								document.getElementById('alamat').value = dt_pasien[kode_pasien].alamat;
							}
						</script>
						<div class="form-group">
							<label for="nama_pasien">Nama Pasien</label>
							<input name="nama_pasien" id="nama_pasien" type="text" class="form-control" value="" disabled>
						</div>
						<div class="form-group">
							<label for="id_unitmedis">ID. Unit Medis</label>
							<select name="id_unitmedis" class="form-control">
								<option value=0>-Pilih-</option>
								<?php
								$result = mysqli_query($conn, "SELECT * FROM tb_unitmedis");
								while ($row = mysqli_fetch_array($result)) {
									echo '<option value="' . $row['id_unitmedis'] . '">' . $row['id_unitmedis'] . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="diagnosa1">Diagnosa</label>
							<input name="diagnosa" type="text" class="form-control" value="">
						</div>
						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<input name="keterangan" type="text" class="form-control" value="" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="tanggal">Tgl. Rekam Medis</label>
							<input name="tanggal" type="text" class="form-control" value="<?php echo $tglsekarang; ?>">
						</div>
						<div class="form-group">
							<button name="simpan" type="submit" class="btn btn-primary">Simpan</button>
							<button name="batal" type="reset" class="btn btn-warning" onclick="location.href='data-rekmed.php';">Batal</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php
}
?>