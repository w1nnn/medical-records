<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
    exit; // Exiting to prevent further execution
} else {
    include "../../koneksi/koneksi.php";

    if (isset($_POST['simpan'])) {
        // Mengambil nilai dari form
        $kode_pasien = $_POST['kode_pasien'];
        $nama_pasien = $_POST['nama_pasien'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $pekerjaan = $_POST['pekerjaan'];
        $telpon = $_POST['telpon'];
        $email = $_POST['email'];
        // Query untuk menyimpan data ke dalam tabel
        $sql_insert = "INSERT INTO tb_pasien (kode_pasien, nama_pasien, tanggal_lahir, jenis_kelamin, pekerjaan, alamat, telpon, email) 
                       VALUES ('$kode_pasien', '$nama_pasien', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$pekerjaan', '$telpon', '$email')";

        // Eksekusi query
        $result = mysqli_query($conn, $sql_insert);

        if ($result) {
            echo "<script>alert('Data pasien berhasil disimpan');</script>";
            echo "<script>window.location='?page=pasien';</script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data');</script>";
        }
    } elseif (isset($_POST['edit'])) {
        // Mengambil nilai dari form
        $kode_pasien = $_POST['kode_pasien'];
        $nama_pasien = $_POST['nama_pasien'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $pekerjaan = $_POST['pekerjaan'];
        $telpon = $_POST['telpon'];
        $email = $_POST['email'];

        // Query untuk melakukan update data ke dalam tabel
        $sql_update = "UPDATE tb_pasien SET 
                       nama_pasien = '$nama_pasien', 
                       tanggal_lahir = '$tanggal_lahir', 
                       jenis_kelamin = '$jenis_kelamin', 
                       alamat = '$alamat', 
                       pekerjaan = '$pekerjaan', 
                       telpon = '$telpon',
                       email = '$email'
                       WHERE kode_pasien = '$kode_pasien'";

        // Eksekusi query
        $result = mysqli_query($conn, $sql_update);

        if ($result) {
            echo "<script>alert('Data pasien berhasil diupdate');</script>";
            echo "<script>window.location='?page=pasien';</script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengupdate data');</script>";
        }
    }
}
