<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen');
                    window.location = '../../index.php'</script>";
} else {

?>

	<?php
	include "../../koneksi/koneksi.php";
	$sql = "SELECT MAX(RIGHT(kode_obat,4)) AS terakhir FROM tb_obat";
	$hasil = mysqli_query($conn, $sql);
	$data = mysqli_fetch_array($hasil);
	$lastID = $data['terakhir'];
	$lastNoUrut = (int) $lastID;
	$nextNoUrut = $lastNoUrut + 1;
	$nextID = "OBT-" . sprintf("%04s", $nextNoUrut);


	?>
	<form action="" method="POST" id="keywordForm">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="alert alert-info">
							<b>Form</b> Tambah Data Obat
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control" name="type_farmasi" id="type_farmasi">
										<option>Jenis Farmasi ...</option>
										<option value="medicine">Medis</option>
										<option value="vaccine">Vaksin</option>
										<option value="supplement">Suplemen</option>
										<option value="herbal">Herbal</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="input-group mb-3">
										<input type="text" name="nama_obat" class="form-control" placeholder="" aria-label="">
										<div class="input-group-append">
											<button name="cari" type="submit" class="btn btn-primary" type="button">Cari Obat</button>
										</div>
									</div>
								</div>
							</div>
						</div>


						<h6>Data Berdasarkan Pencarian Obat</h6>
						<table class='table table-striped' id='table-2' style='width: 100%;'>
							<thead class='table-light'>
								<tr>
									<th class='text-center'>
										<i class='fas fa-th'></i>
									</th>
									<th>Nama Produk</th>
									<th style='width: 200px;'>Detail Produk</th>
									<th>Tipe Produk</th>
									<th>NIE</th>
									<th>Kode KFA</th>
									<th>Manufaktur</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (isset($_POST['cari'])) {
									$namaObat = $_POST['nama_obat'];
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL, "https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials");
									curl_setopt($ch, CURLOPT_POST, true);
									curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
										'client_id' => 'avNTLub56CJ7Df8kjAJO3NJNGA9eD6gLOEa7SsDuVixiGnt0',
										'client_secret' => 'wZDklugM43NpUat5MuqAmUslYvdgLaEyQ9XLJRtGDCiHzrMsb2r2eMm2rcf5pJMI'
									)));
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($ch, CURLOPT_HTTPHEADER, array(
										'Content-Type: application/x-www-form-urlencoded'
									));
									curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

									$output = curl_exec($ch);

									if ($output === false) {
										echo json_encode(['error' => curl_error($ch)]);
										curl_close($ch);
										exit();
									}

									$data = json_decode($output, true);
									$access_token = $data['access_token'];

									curl_close($ch);

									$ch = curl_init();
									$product_url = "https://api-satusehat-stg.dto.kemkes.go.id/kfa-v2/products/all?page=1&size=100&product_type=farmasi&keyword=" . $namaObat;
									curl_setopt($ch, CURLOPT_URL, $product_url);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($ch, CURLOPT_HTTPHEADER, array(
										'Authorization: Bearer ' . $access_token,
										'Accept: application/json'
									));
									curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

									$product_output = curl_exec($ch);

									if ($product_output === false) {
										echo json_encode(['error' => curl_error($ch)]);
									} else {
										$response = json_decode($product_output, true);


										foreach ($response['items']['data'] as $product) {
											$namaDagang = $product['nama_dagang'] == null ? $product['name'] : $product['nama_dagang'];
											$name = $product['name'];
											$dosage_form = $product['dosage_form']['name'];
											$nie = $product['nie'];
											$kfa_code = $product['kfa_code'];
											$manufacturer = $product['manufacturer'];

											echo "
										<tr>
											<td class='text-center'>
												<input type='checkbox' name='product[]' value='$product[id]'>
											</td>
											<td>$namaDagang</td>
											<td>$name</td>
											<td>$dosage_form</td>
											<td>$nie</td>
											<td>$kfa_code</td>
											<td>$manufacturer</td>
										</tr>
						
										";
										}

										curl_close($ch);
									}
								}
								?>
							</tbody>
						</table>
						<h6 style="margin-top: 50px;">Data Berdasarkan Tipe Farmasi</h6>
						<table class="table table-striped" id="table-2" style="width: 100%;">
							<thead class="table-light">
								<tr>
									<th class="text-center">
										<i class="fas fa-th"></i>
									</th>
									<th>Nama Produk</th>
									<th style="width: 200px;">Detail Produk</th>
									<th>Tipe Produk</th>
									<th>NIE</th>
									<th>Kode KFA</th>
									<th>Manufaktur</th>
								</tr>
							</thead>
							<tbody id="table-body">
							</tbody>
						</table>
						<!-- <div class="card-footer text-right">
							<button name="simpan" type="submit" class="btn btn-primary mr-1">Simpan</button>
							<a href="?page=obat" class="btn btn-sm btn-warning" type="reset">Batal</a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</form>

	<script>
		document.getElementById('type_farmasi').addEventListener('change', async function() {
			const typeFarmasi = this.value.trim();
			const tableBody = document.getElementById('table-body');

			if (typeFarmasi.length > 0) {
				try {
					const response = await fetch('../hal/obat/api-obat.php', {
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
					const products = data.items.data;
					tableBody.innerHTML = '';
					products.map((product) => {
						const str = product.name;
						const firstWord = str.split(' ')[0];
						const namaDagang = product.nama_dagang == null ? firstWord : product.nama_dagang;
						const tr = document.createElement('tr');
						tr.innerHTML = `
							<td class="text-center">
								<input type="checkbox" name="product[]" value="${product.id}">
							</td>
							<td>${firstWord}</td>
							<td>${product.name}</td>
							<td>${product.dosage_form.name}</td>
							<td>${product.nie}</td>
							<td>${product.kfa_code}</td>
							<td>${product.manufacturer}</td>
						`;
						tableBody.appendChild(tr);
					});

				} catch (error) {
					console.error('Error:', error);
				}
			} else {
				tableBody.innerHTML = '';
			}
		});
	</script>
<?php
}
?>