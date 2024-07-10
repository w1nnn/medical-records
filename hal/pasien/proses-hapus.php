<?php
include "../../koneksi/koneksi.php";

if (isset($_GET['kode_pasien'])) {
    $kode_pasien = $_GET['kode_pasien'];

    $stmt = $conn->prepare("DELETE FROM tb_pasien WHERE kode_pasien = ?");
    $stmt->bind_param("s", $kode_pasien);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Data telah dihapus!');
            window.location='?page=pasien';
            </script>";
    } else {
        echo "<script>
            alert('Data tidak ditemukan atau tidak dapat dihapus!');
            window.location='?page=pasien';
            </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('Kode pasien tidak ditemukan!');
        window.location='?page=pasien';
        </script>";
}

$conn->close();
