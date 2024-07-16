<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
    exit; // Exiting to prevent further execution
} else {
    include "../../koneksi/koneksi.php";

    if (isset($_POST['simpan'])) {
        // Mengambil nilai dari form
        $no_rekmed = $_POST['no_rekmed'];
        $kode_pasien = $_POST['kode_pasien'];
        $id_unitmedis = $_POST['id_unitmedis'];
        $diagnosa = $_POST['diagnosa'];
        $keterangan = $_POST['keterangan'];
        $tanggal = $_POST['tanggal'];
        // Query untuk menyimpan data ke dalam tabel
        $sql_insert = "INSERT INTO tb_rekmed (no_rekmed, kode_pasien, id_unitmedis, diagnosa, keterangan, tanggal) 
                       VALUES ('$no_rekmed', '$kode_pasien', '$id_unitmedis', '$diagnosa', '$keterangan', '$tanggal')";

        // Eksekusi query
        $result = mysqli_query($conn, $sql_insert);

        if ($result) {
            echo "<script>alert('Data pasien berhasil disimpan');</script>";
            echo "<script>window.location='?page=rekam-medis';</script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data');</script>";
        }
    } elseif (isset($_POST['edit'])) {
        // Mengambil nilai dari form
        $no_rekmed = $_POST['no_rekmed'];
        $kode_pasien = $_POST['kode_pasien'];
        $id_unitmedis = $_POST['id_unitmedis'];
        $diagnosa = $_POST['diagnosa'];
        $keterangan = $_POST['keterangan'];
        $tanggal = $_POST['tanggal'];
        // Query untuk melakukan update data ke dalam tabel
        $sql_update = "UPDATE tb_rekmed SET 
        kode_pasien = '$kode_pasien', 
        id_unitmedis = '$id_unitmedis', 
        diagnosa = '$diagnosa', 
        keterangan = '$keterangan', 
        tanggal = '$tanggal'
        WHERE no_rekmed = '$no_rekmed'";

        // Eksekusi query
        $result = mysqli_query($conn, $sql_update);

        if ($result) {
            echo "<script>alert('Data pasien berhasil diupdate');</script>";
            echo "<script>window.location='?page=rekam-medis';</script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengupdate data');</script>";
        }
    }
}
