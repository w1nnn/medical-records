<?php
include "../../koneksi/koneksi.php";

if (isset($_GET['no_reg'])) {
    $n_reg = $_GET['no_reg'];

    $stmt = $conn->prepare("DELETE FROM tb_kunjungan WHERE no_reg = ?");
    $stmt->bind_param("s", $n_reg);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Data telah dihapus!');
            window.location='?page=pendaftaran-pasien';
            </script>";
    } else {
        echo "<script>
            alert('Data tidak ditemukan atau tidak dapat dihapus!');
            window.location='?page=pendaftaran-pasien';
            </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('Kode pasien tidak ditemukan!');
        window.location='?page=pendaftaran-pasien';
        </script>";
}

$conn->close();
