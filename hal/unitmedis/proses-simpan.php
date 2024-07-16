<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
    exit;
} else {
    include "../../koneksi/koneksi.php";

    if (isset($_POST['simpan'])) {
        $id_unitmedis = $_POST['id_unitmedis'];
        $nama_unitmedis = $_POST['nama_unitmedis'];
        $spesialis = $_POST['spesialis'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['telpon'];
        $sql_insert = "INSERT INTO tb_unitmedis (id_unitmedis, nama_unitmedis, spesialis, alamat, telpon) 
                       VALUES ('$id_unitmedis', '$nama_unitmedis', '$spesialis', '$alamat', '$telpon')";

        $result = mysqli_query($conn, $sql_insert);

        if ($result) {
            echo "<script>alert('Data pasien berhasil disimpan');</script>";
            echo "<script>window.location='?page=unit-medis';</script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data');</script>";
        }
    } elseif (isset($_POST['edit'])) {
        $id_unitmedis = $_POST['id_unitmedis'];
        $nama_unitmedis = $_POST['nama_unitmedis'];
        $spesialis = $_POST['spesialis'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['telpon'];


        $sql_update = "UPDATE tb_unitmedis SET nama_unitmedis = '$nama_unitmedis', spesialis = '$spesialis', alamat = '$alamat', telpon = '$telpon' WHERE id_unitmedis = '$id_unitmedis'";
        $result = mysqli_query($conn, $sql_update);
        if ($result) {
            echo "<script>alert('Data pasien berhasil diubah');</script>";
            echo "<script>window.location='?page=unit-medis';</script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengubah data');</script>";
        }
    }
}
