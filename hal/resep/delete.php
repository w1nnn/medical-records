<?php
include "../../koneksi/koneksi.php";

if (isset($_GET['no_resep'])) {
    $no_resep = $_GET['no_resep'];
    // var_dump($no_resep);
    $stmt = $conn->prepare("DELETE FROM tb_resep_detail WHERE no_resep = ?");
    $stmt->bind_param("s", $no_resep);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Data telah dihapus!');
            window.location='?page=resep-dokter&act=add';
            </script>";
    } else {
        echo "<script>
            alert('Data tidak ditemukan atau tidak dapat dihapus!');
            window.location='?page=resep-dokter&act=add';
            </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('Kode pasien tidak ditemukan!');
        window.location='?page=resep-dokter&act=add';
        </script>";
}

$conn->close();
