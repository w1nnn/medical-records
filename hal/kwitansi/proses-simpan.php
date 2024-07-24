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

    // Periksa apakah data dengan no_rekmed yang sama sudah ada
    $checkQuery = "SELECT COUNT(*) FROM tb_kwitansi WHERE no_rekam_medis = ?";
    $checkStmt = $conn->prepare($checkQuery);
    if ($checkStmt) {
        $checkStmt->bind_param("s", $noRekmed);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo "<script language='javascript'>alert('Data dengan nomor rekam medis ini sudah ada.'); window.location = '?page=transaksi'</script>";
        } else {
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
    } else {
        echo "<script language='javascript'>alert('Gagal mempersiapkan statement: " . $conn->error . "'); window.location = '?page=transaksi'</script>";
    }
}
?>

?>