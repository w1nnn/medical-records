<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
    exit; // Exiting to prevent further execution
} else {
    include "../../koneksi/koneksi.php";

    if (isset($_POST['edit'])) {
        $kfa = $_POST['kfa'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        $sql_update = "UPDATE tb_obat SET 
                       harga = '$harga', 
                       stok = '$stok'
                       WHERE kfa = '$kfa'";

        $result = mysqli_query($conn, $sql_update);

        if ($result) {
            echo "<script>alert('Data pasien berhasil diupdate');</script>";
            echo "<script>window.location='?page=obat';</script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengupdate data');</script>";
            echo "<script>window.location='?page=obat';</script>";
        }
    }
}
