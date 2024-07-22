<?php
include "../../koneksi/koneksi.php";

if (isset($_POST['simpan'])) {
    $kodePasien = $_POST['kode_pasien'];
    $namaPasien = $_POST['nama_pasien'];
    $telpon = $_POST['telpon'];
    $email = $_POST['email'];
    $noRekmed = $_POST['no_rekmed'];
    $diagnosa = $_POST['diagnosa'];
    $keterangan = $_POST['keterangan'];
    $resep = $_POST['no_resep'];

    $query = "INSERT INTO tb_kwitansi (kode_pasien, nama_pasien, telepon, email, no_rekam_medis, diagnosa, keterangan, no_resep) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssssssss", $kodePasien, $namaPasien, $telpon, $email, $noRekmed, $diagnosa, $keterangan, $resep);

        if ($stmt->execute()) {
            echo "<script language='javascript'>alert('Data berhasil ditambahkan'); window.location = '?page=transaksi'</script>";
        } else {
            echo "<script language='javascript'>alert('Data gagal ditambahkan: " . $stmt->error . "'); window.location = '?page=transaksi'</script>";
        }
        $stmt->close();
    } else {
        echo "<script language='javascript'>alert('Gagal mempersiapkan statement: " . $conn->error . "'); window.location = '?page=transaksi'</script>";
    }
}
