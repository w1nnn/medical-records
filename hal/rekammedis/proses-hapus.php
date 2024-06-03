<?php
/* Memasukkan koneksi */
require_once("../../koneksi/koneksi.php");

/* Memanggil variable dan nilai */
if (isset($_GET['no_rekmed'])) {
    $no_rekmed = $_GET['no_rekmed'];

    // Memasukkan nilai ke dalam tabel
    $ubah = mysqli_query($conn, "DELETE FROM tb_rekmed WHERE no_rekmed = '$no_rekmed'");

    echo "<script>window.alert('Data $no_rekmed Sudah Dihapus');
    window.location='data-rekmed.php';</script>";
}
