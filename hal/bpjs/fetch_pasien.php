<?php
include "../../koneksi/koneksi.php";

header('Content-Type: application/json');

$postData = json_decode(file_get_contents('php://input'), true);

if (isset($postData['kode_pasien'])) {
    $kode_pasien = $postData['kode_pasien'];

    $query = "SELECT nama_pasien, telpon, email, alamat FROM tb_pasien WHERE kode_pasien = '$kode_pasien'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    } else {
        echo json_encode(['error' => 'Database query failed']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
