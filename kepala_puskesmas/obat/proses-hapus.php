<?php
include "../../koneksi/koneksi.php";

if (isset($_GET['kfa'])) {
    $kfa = $_GET['kfa'];

    $stmt = $conn->prepare("DELETE FROM tb_obat WHERE kfa = ?");
    $stmt->bind_param("s", $kfa);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Data telah dihapus!');
            window.location='?page=obat';
            </script>";
    } else {
        echo "<script>
            alert('Data tidak ditemukan atau tidak dapat dihapus!');
            window.location='?page=obat';
            </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('Kode obat tidak ditemukan!');
        window.location='?page=obat';
        </script>";
}

$conn->close();
