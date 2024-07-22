<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen');
          window.location = '../../index.php'</script>";
	exit;
}

include "../../koneksi/koneksi.php";

function getCurrentDate()
{
	date_default_timezone_set('Asia/Jakarta');
	return date("Y-m-d", mktime(date("m"), date("d"), date("Y")));
}

function generateOptions($conn, $tableName, $idField, $valueField)
{
	$options = "";
	$result = mysqli_query($conn, "SELECT * FROM $tableName");
	while ($row = mysqli_fetch_array($result)) {
		$kode_pasien = $row[$idField];
		$rekmed_result = mysqli_query($conn, "SELECT no_rekmed, diagnosa, keterangan FROM tb_rekmed WHERE kode_pasien = '$kode_pasien'");
		$rekmed_row = mysqli_fetch_array($rekmed_result);
		$no_rekmed = $rekmed_row['no_rekmed'] ?? '';
		$diagnosa = $rekmed_row['diagnosa'] ?? '';
		$keterangan = $rekmed_row['keterangan'] ?? '';

		$options .= '<option value="' . $row[$idField] . '" 
                     data-nama="' . addslashes($row['nama_pasien']) . '" 
                     data-telp="' . addslashes($row['telpon']) . '"
                     data-email="' . addslashes($row['email']) . '"
                     data-no-rekmed="' . addslashes($no_rekmed) . '"
                     data-diagnosa="' . addslashes($diagnosa) . '"
                     data-keterangan="' . addslashes($keterangan) . '">' . $row[$valueField] . '</option>';
	}
	return $options;
}
$tglsekarang = getCurrentDate();


?>
<form action="?page=transaksi&act=save" method="POST">
	<div class="row">
		<div class="col-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
						<b>Form</b> Tambah Data Pasien
					</div>
					<div class="form-group">
						<label>Kode Pasien</label>
						<select class="form-control" name="kode_pasien" id="kode_pasien">
							<option>Choose</option>
							<?= generateOptions($conn, "tb_pasien", "kode_pasien", "kode_pasien"); ?>
						</select>
					</div>
					<div class="form-group">
						<label>Nama Pasien</label>
						<input name="nama_pasien" id="nama_pasien" type="text" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>No. Telp</label>
						<input name="telpon" id="telpon" type="text" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input name="email" id="email" type="text" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>No Rekam Medis</label>
						<input name="no_rekmed" id="no_rekmed" type="text" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Diagnosa</label>
						<input name="diagnosa" id="diagnosa" type="text" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<input name="keterangan" id="keterangan" type="text" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>No Resep</label>
						<input type="text" name="no_resep" id="resep" class="form-control" readonly></input>
					</div>
				</div>
				<div class="card-footer text-right">
					<button name="simpan" type="submit" class="btn btn-primary mr-1">Simpan</button>
					<a href="?page=transaksi" class="btn btn-sm btn-warning" type="reset">Batal</a>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	document.getElementById('kode_pasien').addEventListener('change', async function() {
		const selectedOption = this.options[this.selectedIndex];
		const noRekmed = selectedOption.getAttribute('data-no-rekmed');

		document.getElementById('nama_pasien').value = selectedOption.getAttribute('data-nama');
		document.getElementById('telpon').value = selectedOption.getAttribute('data-telp');
		document.getElementById('email').value = selectedOption.getAttribute('data-email');
		document.getElementById('no_rekmed').value = noRekmed;
		document.getElementById('diagnosa').value = selectedOption.getAttribute('data-diagnosa');
		document.getElementById('keterangan').value = selectedOption.getAttribute('data-keterangan');

		try {
			const response = await fetch('../hal/kwitansi/fetch-resep.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					no_rekmed: noRekmed
				})
			});

			const data = await response.json();
			console.log(data);
			if (data.resep) {
				document.getElementById('resep').value = data.resep.join(', ');
			} else if (data.error) {
				console.error('Error:', data.error);
			}
		} catch (error) {
			console.error('Error fetching data:', error);
		}
	});
</script>