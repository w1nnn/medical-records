<?php
include "../../koneksi/koneksi.php";

if (isset($_POST['type_farmasi'])) {
    $type_farmasi = $_POST['type_farmasi'];

    $query = "SELECT * FROM tb_obat WHERE tipe_farmasi = '$type_farmasi'";
    $result = mysqli_query($conn, $query);

    $obat = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $obat[] = $row;
    }

    echo json_encode($obat);
}
