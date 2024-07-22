<?php
include "../../koneksi/koneksi.php";

if (isset($_GET['id_kwitansi'])) {
    $no_kwitansi = $_GET['id_kwitansi'];

    $stmt = $conn->prepare("DELETE FROM tb_kwitansi WHERE id_kwitansi = ?");
    $stmt->bind_param("s", $no_kwitansi);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Data telah dihapus!');
            window.location='?page=transaksi';
            </script>";
    } else {
        echo "<script>
            alert('Data tidak ditemukan atau tidak dapat dihapus!');
            window.location='?page=transaksi';
            </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('No kwitansi tidak ditemukan!');
        window.location='?page=transaksi';
        </script>";
}

$conn->close();
