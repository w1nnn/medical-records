<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
	exit; // Exiting to prevent further execution
} else {
	include "../../koneksi/koneksi.php";

	if (isset($_POST['tambah'])) {
		$no_resep = $_POST['no_resep'];
		$kode_obat = $_POST['kode_obat'];
		$nama_obat = $_POST['nama_obat'];
		$qty = $_POST['qty'];
		$aturan_pakai = $_POST['aturan_pakai'];
		$detail_obat = $_POST['detail_obat'];


		if (empty($no_resep) || empty($kode_obat) || empty($nama_obat) || empty($qty) || empty($aturan_pakai)) {
			echo "<script>window.alert('Data tidak lengkap!')
		    window.location='input-resep.php'</script>";
			exit();
		}

		$query = "INSERT INTO tb_resep_detail (no_resep, kode_obat, nama_obat, jumlah, aturan_pakai) VALUES (?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($query);

		if ($stmt) {
			$stmt->bind_param("sssis", $no_resep, $kode_obat, $detail_obat, $qty, $aturan_pakai);
			$simpan = $stmt->execute();
			$stmt->close();

			if ($simpan) {
				echo "<script>
		            alert('Data $nama_obat berhasil ditambahkan');
		            window.location='?page=resep-dokter&act=add'
		        </script>";
			} else {
				echo "<script>window.alert('Data $nama_obat GAGAL ditambah!!!')
		        window.location='?page=resep-dokter&act=add'</script>";
			}
		} else {
			echo "<script>window.alert('Gagal menyiapkan query.')
		    window.location='?page=resep-dokter&act=add'</script>";
		}
	} else {
		echo "<script>window.alert('Data Tidak Tersimpan')
        window.location='?page=resep-dokter'</script>";
	}
}
