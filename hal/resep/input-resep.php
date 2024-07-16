<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {
?>
	<div class="container mt-4">

		<div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
			<strong>Input Data Resep Obat</strong>
		</div>

		<div class="row">
			<div class="col-md-6">
				<form action="proses-tambah.php" method="post">
					<?php
					include "../../koneksi/koneksi.php";
					$sqlx = "SELECT MAX(RIGHT(no_resep,4)) AS terakhir FROM tb_resep";
					$hasilx = mysqli_query($conn, $sqlx);
					$datax = mysqli_fetch_array($hasilx);
					$lastIDx = $datax['terakhir'];
					$lastNoUrutx = (int) $lastIDx;
					$nextNoUrutx = $lastNoUrutx + 1;
					$nextIDx = "RSP-" . sprintf("%04s", $nextNoUrutx);
					?>
					<input name="no_resep" type="text" value="<?php echo $nextIDx; ?>" hidden>
					<div class="form-group">
						<select class="form-control" name="type_farmasi" id="type_farmasi">
							<option>Jenis Obat ...</option>
							<option value="medicine">Umum</option>
							<option value="vaccine">Vaksin</option>
							<option value="supplement">Suplemen</option>
							<option value="herbal">Herbal</option>
						</select>
					</div>
					<div class="form-group">
						<label for="nama_obat">Nama Obat</label>
						<select name="nama_obat" id="nama_obat" class="form-control" required>
							<option value="0">-Pilih-</option>

						</select>

					</div>
					<div class="form-group">
						<label for="detail_obat">Detail Obat</label>
						<input type="text" name="detail_obat" id="detail_obat" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label for="bentuk">Bentuk</label>
						<input type="text" name="bentuk" id="bentuk" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label for="kode_obat">Kode KFA</label>
						<input type="text" name="kode_obat" id="kode_obat" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label for="nie">No Izin Edar (NIE)</label>
						<input type="text" name="nie" id="nie" class="form-control" readonly>
					</div>

					<div class="form-group">
						<label for="stok">Sisa Stok</label>
						<input type="text" name="stok" id="stok" class="form-control" readonly>
					</div>

					<div class="form-group">
						<label for="qty">QTY</label>
						<input type="text" name="qty" id="qty" class="form-control" required>
					</div>

					<div class="form-group">
						<label for="aturan_pakai">Aturan Pakai</label>
						<input type="text" name="aturan_pakai" id="aturan_pakai" class="form-control" required>
					</div>

					<button type="submit" name="tambah" class="btn btn-primary btn-sm">Tambah</button>
				</form>
			</div>

			<div class="col-md-6">
				<form action="proses-simpan.php" method="post">
					<?php
					include "../../koneksi/koneksi.php";
					$sql = "SELECT MAX(RIGHT(no_resep,4)) AS terakhir FROM tb_resep";
					$hasil = mysqli_query($conn, $sql);
					$data = mysqli_fetch_array($hasil);
					$lastID = $data['terakhir'];
					$lastNoUrut = (int) $lastID;
					$nextNoUrut = $lastNoUrut + 1;
					$nextID = "RSP-" . sprintf("%04s", $nextNoUrut);
					?>
					<div class="form-group">
						<label for="no_resep">NO. RESEP</label>
						<input type="text" name="no_resep" class="form-control" value="<?php echo $nextID; ?>" disabled>
						<input type="hidden" name="no_resepx" value="<?php echo $nextID; ?>">
					</div>

					<div class="form-group">
						<label for="no_rekmed">No. Rekam Medis</label>
						<select name="no_rekmed" id="no_rekmed" class="form-control" onchange="noRekmed(this.value)" required>
							<option value="0">-Pilih-</option>
							<?php
							include "../../koneksi/koneksi.php";
							$resul = mysqli_query($conn, "select * from tb_rekmed");
							$jsArrayz = "var dt_rekmed = new Array();\n";
							while ($row = mysqli_fetch_array($resul)) {
								echo '<option value="' . $row['no_rekmed'] . '">' . $row['no_rekmed'] . '</option>';
								$jsArrayz .= "dt_rekmed['" . $row['no_rekmed'] . "'] = {kode_pasien:'" . addslashes($row['kode_pasien']) . "'};\n";
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="kode_pasien">Kode Pasien</label>
						<input type="text" name="kode_pasien" id="kode_pasien" class="form-control" readonly>
					</div>

					<div class="form-group">
						<label for="tanggal">Tanggal Resep</label>
						<input type="text" name="tanggal" id="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
					</div>
					<div class="d-flex justify-content-end">
						<button type="submit" name="simpan" class="btn btn-sm btn-primary mx-2">Simpan</button>
						<button type="reset" name="batal" class="btn btn-danger btn-sm">Batal</button>
					</div>
				</form>
			</div>
		</div>

		<script type="text/javascript">
			<?php echo $jsArrayz; ?>

			function noRekmed(no_rekmed) {
				document.getElementById('kode_pasien').value = dt_rekmed[no_rekmed].kode_pasien;
			}
		</script>

		<div class="content mt-4">
			<?php
			$result = mysqli_query($conn, "select * from tb_resep_detail where no_resep = '$nextID'");
			?>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode Obat</th>
						<th>Nama Obat</th>
						<th>Qty</th>
						<th>Aturan Pakai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					while ($data = mysqli_fetch_array($result)) {
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['kode_obat']; ?></td>
							<td><?php echo $data['nama_obat']; ?></td>
							<td><?php echo $data['jumlah']; ?></td>
							<td><?php echo $data['aturan_pakai']; ?></td>
							<td>
								<center><a href="proses-hapus.php?id=<?php echo $data['id_resep']; ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data?')">Hapus</a></center>
							</td>
						</tr>
					<?php
						$no++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<script>
		document.getElementById('type_farmasi').addEventListener('change', async function() {
			const typeFarmasi = this.value.trim();
			const namaObatSelect = document.getElementById('nama_obat');

			if (typeFarmasi.length > 0) {
				try {
					const response = await fetch('../hal/resep/get_tipe_obat.php', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						},
						body: 'type_farmasi=' + encodeURIComponent(typeFarmasi)
					});

					if (!response.ok) {
						throw new Error('Network response was not ok');
					}

					const data = await response.json();
					let options = '<option value="0">-Pilih-</option>';
					data.forEach(item => {
						options += `<option value="${item.kfa}">${item.nama_produk} -- ${item.kfa} --</option>`;
					});
					namaObatSelect.innerHTML = options;

				} catch (error) {
					console.error('Error:', error);
				}
			} else {
				tableBody.innerHTML = '';
			}
		});

		document.getElementById('nama_obat').addEventListener('change', async function() {
			const namaObat = this.value.trim();
			const detailObat = document.getElementById('detail_obat');
			const bentuk = document.getElementById('bentuk');
			const kodeObat = document.getElementById('kode_obat');
			const nie = document.getElementById('nie');
			const stok = document.getElementById('stok');

			if (namaObat.length > 0) {
				try {
					const response = await fetch('../hal/resep/get_detail_obat.php', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						},
						body: 'nama_obat=' + encodeURIComponent(namaObat)
					});

					if (!response.ok) {
						throw new Error('Network response was not ok');
					}

					const dataByName = await response.json();
					detailObat.value = dataByName[0].detail_produk;
					bentuk.value = dataByName[0].bentuk;
					kodeObat.value = dataByName[0].kfa;
					nie.value = dataByName[0].nie;
					stok.value = dataByName[0].stok;



				} catch (error) {
					console.error('Error:', error);
				}
			} else {
				detailObat.value = '';
				bentuk.value = '';
				kodeObat.value = '';
				nie.value = '';
				jumlah.value = '';
			}
		});
	</script>
<?php
}
?>