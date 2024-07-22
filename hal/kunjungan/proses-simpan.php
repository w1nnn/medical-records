<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen'); window.location = '../../index.php'</script>";
    exit; // Exiting to prevent further execution
} else {
    include "../../koneksi/koneksi.php";

    if (isset($_POST['simpan'])) {
        $jenis_layanan = $_POST['jenis_layanan'];
        $no_reg = $_POST['no_reg'];
        $tgl_reg = $_POST['tanggal_reg'];
        $unitTujuan = $_POST['unit_tujuan'];
        $kode_pasien = $_POST['kode_pasien'];
        $nama_pasien = $_POST['nama_pasien'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];

        $sql_insert = "INSERT INTO tb_kunjungan (jenis_layanan, no_reg, tgl_reg, unit_tujuan, kode_pasien, nama_pasien, jenis_kelamin, alamat) 
                       VALUES ('$jenis_layanan', '$no_reg', '$tgl_reg', '$unitTujuan', '$kode_pasien', '$nama_pasien', '$jenis_kelamin', '$alamat')";

        // Eksekusi query
        $result = mysqli_query($conn, $sql_insert);

        if ($result) {
            echo "<script>alert('Data pasien berhasil disimpan');</script>";
            echo "<script>window.location='?page=pendaftaran-pasien';</script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data');</script>";
        }
    } elseif (isset($_POST['edit'])) {
        $jenis_layanan = $_POST['jenis_layanan'];
        $no_reg = $_POST['no_reg'];
        $tgl_reg = $_POST['tanggal_reg'];
        $unit_tujuan = $_POST['unit_tujuan'];
        $kode_pasien = $_POST['kode_pasien'];
        $nama_pasien = $_POST['nama_pasien'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];

        $sql_update = "UPDATE tb_kunjungan SET unit_tujuan = '$unit_tujuan', jenis_layanan = '$jenis_layanan', kode_pasien = '$kode_pasien', nama_pasien = '$nama_pasien', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat' WHERE no_reg = '$no_reg'";

        $result_update = mysqli_query($conn, $sql_update);

        if ($result_update) {
            echo "<script>alert('Data pasien berhasil diupdate');</script>";
            echo "<script>window.location='?page=pendaftaran-pasien';</script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengupdate data');</script>";
        }
    }
}
