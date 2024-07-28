<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
    exit; // Exiting to prevent further execution
} else {
    include "../../koneksi/koneksi.php";

    if (isset($_POST['simpan'])) {
        $no_resep = $_POST['no_resep'];
        $no_rekmed = $_POST['no_rekmed'];
        $tanggal = $_POST['tanggal'];

        if (empty($no_resep) || empty($no_rekmed) || empty($tanggal)) {
            echo "<script>window.alert('Data tidak lengkap!')
            window.location='data-resep.php&act=add'</script>";
            exit();
        }

        $checkQuery = "SELECT COUNT(*) FROM tb_resep WHERE no_rekmed = ?";
        $checkStmt = $conn->prepare($checkQuery);
        if ($checkStmt) {
            $checkStmt->bind_param("s", $no_rekmed);
            $checkStmt->execute();
            $checkStmt->bind_result($count);
            $checkStmt->fetch();
            $checkStmt->close();

            echo "<script>window.alert('Data dengan nomor rekam medis ini sudah ada.')
                window.location='?page=resep-dokter&act=add'</script>";
            $query = "INSERT INTO tb_resep (no_resep, no_rekmed, tanggal) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("sss", $no_resep, $no_rekmed, $tanggal);
                $simpan = $stmt->execute();
                $stmt->close();

                if ($simpan) {
                    echo "<script>window.alert('Data Sudah Tersimpan')
                        window.location='?page=resep-dokter&act=add'</script>";
                } else {
                    echo "<script>window.alert('Data GAGAL disimpan!')
                        window.location='?page=resep-dokter&act=add'</script>";
                }
            } else {
                echo "<script>window.alert('Gagal menyiapkan query.')
                    window.location='?page=resep-dokter'</script>";
            }
        } else {
            echo "<script>window.alert('Gagal menyiapkan query.')
            window.location='?page=resep-dokter'</script>";
        }
    }
}
