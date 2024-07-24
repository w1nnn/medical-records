<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen');
            window.location = '../../index.php'</script>";
} else {

	include "../../koneksi/koneksi.php";
?>

	<form action="" method="POST" id="keywordForm">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="alert" style="background-color: #8BC6EC;background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
							<b>Form</b> Tambah Data Obat
						</div>
						<div class="row">
							<div class="col-md-6">
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="input-group mb-3">
										<input style="border-radius: 20px 0 0 20px;" type="text" name="nama_obat" class="form-control" placeholder="Contoh: Clindamycin" aria-label="">
										<div class="input-group-append">
											<button name="cari" style="border-radius: 0 20px 20px 0; background-image: linear-gradient( 109.5deg,  rgba(229,233,177,1) 11.2%, rgba(223,205,187,1) 100.2% ); color: #000;" type="submit" class="btn btn-sm" type="button">Cari Obat</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<button class="btn btn-sm btn-info" title="Anda akan menambahkan data yang dipilih ke inventory anda" name="simpan" type="submit">Tambahkan</button>
						<a href="?page=obat" class="btn btn-sm btn-warning">Batal</a>
						<h6 class="mt-4">Data Berdasarkan Pencarian Obat</h6>
						<table class='table table-striped table-hover' id='table-2' style='width: 100%;'>
							<thead class='table-light'>
								<tr>
									<th class='text-center'>
										<i class='fas fa-th'></i>
									</th>
									<th>Nama Produk</th>
									<th style='width: 200px;'>Detail Produk</th>
									<th>Bentuk Produk</th>
									<th>NIE</th>
									<th>Kode KFA</th>
									<th>Manufaktur</th>
									<th>Zat Aktif</th>
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
											// var_dump($product);
											$typeFarmasi = $product['farmalkes_type']['code'];
											$namaDagang = $product['nama_dagang'] == null ? $product['name'] : $product['nama_dagang'];
											$name = $product['name'];
											$dosage_form = $product['dosage_form']['name'];
											$nie = $product['nie'];
											$kfa_code = $product['kfa_code'];
											$manufacturer = $product['manufacturer'];
											$zat_aktif = $product['active_ingredients'][0]['zat_aktif'];
											$JumlahZatAktif = $product['active_ingredients'][0]['kekuatan_zat_aktif'];
											$hargaFix = $product['fix_price'];
											$hetPrice = $product['het_price'];
											$harga = $hargaFix == 0 ? $hetPrice : $hargaFix;
											$formatHarga = number_format($harga, 0, ',', '.');
											echo "
                                        <tr>
                                            <td class='text-center'>
                                                <input type='checkbox' name='products[]' value='" . json_encode($product) . "'>
                                            </td>
                                            <td>$namaDagang</td>
                                            <td>$name</td>
                                            <td>$dosage_form</td>
                                            <td>$nie</td>
                                            <td>$kfa_code</td>
                                            <td>$manufacturer</td>
                                            <td>$zat_aktif $JumlahZatAktif</td>
                                        </tr>
                                        ";
										}

										curl_close($ch);
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php
	if (isset($_POST['simpan'])) {
		if (!empty($_POST['products'])) {
			$data = [];
			foreach ($_POST['products'] as $productJson) {
				$product = json_decode($productJson, true);
				$typeFarmasi = $product['farmalkes_type']['code'];
				$namaDagang = $product['nama_dagang'] == null ? $product['name'] : $product['nama_dagang'];
				$name = $product['name'];
				$dosage_form = $product['dosage_form']['name'];
				$zat_aktif = $product['active_ingredients'][0]['zat_aktif'];
				$nie = $product['nie'];
				$kfa_code = $product['kfa_code'];
				$manufacturer = $product['manufacturer'];
				$hargaFix = $product['fix_price'];
				$hetPrice = $product['het_price'];
				$harga = $hargaFix == 0 ? $hetPrice : $hargaFix;

				$data[] = [
					'nama_produk' => $namaDagang,
					'detail_produk' => $name,
					'bentuk' => $dosage_form,
					'zat_aktif' => $zat_aktif,
					'nie' => $nie,
					'kfa' => $kfa_code,
					'manufaktur' => $manufacturer,
					'harga' => $harga,
					'type_farmasi' => $typeFarmasi
				];
			}
			foreach ($data as $obat) {
				$nama_produk = $obat['nama_produk'];
				$detail_produk = $obat['detail_produk'];
				$bentuk = $obat['bentuk'];
				$zat_aktif = $obat['zat_aktif'];
				$nie = $obat['nie'];
				$kfa = $obat['kfa'];
				$manufaktur = $obat['manufaktur'];
				$harga = $obat['harga'];
				$typeFarmasi = $obat['type_farmasi'];

				// Periksa apakah data dengan nie yang sama sudah ada
				$checkStmt = $conn->prepare("SELECT COUNT(*) FROM tb_obat WHERE kfa = ?");
				$checkStmt->bind_param("s", $kfa);
				$checkStmt->execute();
				$checkStmt->bind_result($count);
				$checkStmt->fetch();
				$checkStmt->close();

				if ($count > 0) {
					echo "<script>
					alert('Data obat dengan kode $kfa sudah ada, tidak akan disimpan ulang.');
					window.location = '?page=obat';
					</script>";
					continue;
				}

				$stmt = $conn->prepare("INSERT INTO tb_obat (nama_produk, detail_produk, bentuk, zat_aktif, nie, kfa, manufaktur, tipe_farmasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("ssssssss", $nama_produk, $detail_produk, $bentuk, $zat_aktif, $nie, $kfa, $manufaktur, $typeFarmasi);
				if ($stmt->execute()) {
					echo "<script>
					alert('Data obat berhasil disimpan');
					window.location = '?page=obat';
					</script>";
				} else {
					echo "<script>
					alert('Gagal menyimpan data obat: " . $stmt->error . "');
					window.location = '?page=obat';
					</script>";
				}
				$stmt->close();
			}
		} else {
			echo "<script>alert('Pilih setidaknya satu obat untuk disimpan');</script>";
		}
	}
	?>
<?php
}
?>