<?php
include "../../koneksi/koneksi.php";

if (isset($_POST['nama_obat'])) {
    $nama_obat = $_POST['nama_obat'];

    $query = "SELECT * FROM tb_obat WHERE kfa = '$nama_obat'";
    $result = mysqli_query($conn, $query);

    $obat = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $obat[] = $row;
    }

    echo json_encode($obat);
}
