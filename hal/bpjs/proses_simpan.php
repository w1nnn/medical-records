<?php
include "../../koneksi/koneksi.php";

if (isset($_POST['simpan'])) {
    $no_kartu = $_POST['no_kartu'];
    $nik = $_POST['nik'];
    $kodePasien = $_POST['kode_pasien'];
    $namaPasien = $_POST['nama_pasien'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    $email = $_POST['email'];
    $noRekmed = $_POST['no_rekmed'];
    $diagnosa = $_POST['diagnosa'];
    $keterangan = $_POST['keterangan'];
    $resep = $_POST['no_resep'];

    // Debugging output
    // var_dump($no_kartu, $nik, $kodePasien, $namaPasien, $alamat, $telpon, $email, $noRekmed, $diagnosa, $keterangan, $resep);

    $checkQuery = "SELECT COUNT(*) FROM bpjs WHERE no_rekam_medis = ?";
    $checkStmt = $conn->prepare($checkQuery);
    if ($checkStmt) {
        $checkStmt->bind_param("s", $noRekmed);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo "<script language='javascript'>alert('Data dengan nomor rekam medis ini sudah ada.'); window.location = '?page=bpjs'</script>";
        } else {
            $query = "INSERT INTO bpjs (no_kartu, nik, kode_pasien, nama_pasien, alamat, telepon, email, no_rekam_medis, diagnosa, keterangan, no_resep) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("sssssssssss", $no_kartu, $nik, $kodePasien, $namaPasien, $alamat, $telpon, $email, $noRekmed, $diagnosa, $keterangan, $resep);

                if ($stmt->execute()) {
                    echo "<script language='javascript'>alert('Data berhasil ditambahkan'); window.location = '?page=bpjs'</script>";
                } else {
                    echo "<script language='javascript'>alert('Data gagal ditambahkan: " . $stmt->error . "'); window.location = '?page=bpjs'</script>";
                }
                $stmt->close();
            } else {
                echo "<script language='javascript'>alert('Gagal mempersiapkan statement: " . $conn->error . "'); window.location = '?page=bpjs'</script>";
            }
        }
    } else {
        echo "<script language='javascript'>alert('Gagal mempersiapkan query: " . $conn->error . "'); window.location = '?page=bpjs'</script>";
    }
}
