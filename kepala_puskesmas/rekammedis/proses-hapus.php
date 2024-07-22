<?php
include "../../koneksi/koneksi.php";

if (isset($_GET['no_rekmed'])) {
    $no_rekmed = $_GET['no_rekmed'];

    $stmt = $conn->prepare("DELETE FROM tb_rekmed WHERE no_rekmed = ?");
    $stmt->bind_param("s", $no_rekmed);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Data telah dihapus!');
            window.location='?page=rekam-medis';
            </script>";
    } else {
        echo "<script>
            alert('Data tidak ditemukan atau tidak dapat dihapus!');
            window.location='?page=rekam-medis';
            </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('Kode pasien tidak ditemukan!');
        window.location='?page=rekam-medis';
        </script>";
}

$conn->close();
