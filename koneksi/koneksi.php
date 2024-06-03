<?php
$dbHost = "localhost";
$userName = "root";
$passwd = "";
$dbName = "db_rekam_medis";

// Melakukan koneksi ke database
$conn = mysqli_connect($dbHost, $userName, $passwd);

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Memilih database
$db_selected = mysqli_select_db($conn, $dbName);

// Memeriksa apakah pemilihan database berhasil
if (!$db_selected) {
    die("Database not found: " . mysqli_error($conn));
}
