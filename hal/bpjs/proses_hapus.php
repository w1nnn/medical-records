<?php
include "../../koneksi/koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM bpjs WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Data telah dihapus!');
            window.location='?page=bpjs';
            </script>";
    } else {
        echo "<script>
            alert('Data tidak ditemukan atau tidak dapat dihapus!');
            window.location='?page=bpjs';
            </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('No kwitansi tidak ditemukan!');
        window.location='?page=bpjs';
        </script>";
}

$conn->close();
