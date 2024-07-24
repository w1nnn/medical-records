<?php
include "../../koneksi/koneksi.php";

$rawData = file_get_contents("php://input");

error_log("Incoming raw data: " . $rawData);

$data = json_decode($rawData, true);

error_log("Decoded data: " . print_r($data, true));

if (isset($data['kode_pasien']) && isset($data['stok_update'])) {
    $kode_pasien = $data['kode_pasien'];
    $stok_update = $data['stok_update'];
    $tanggal = date('Y-m-d');
    $totaBayar = $data['total_bayar'];
    $id_obat = $data['id_obat'];
    $update = mysqli_query($conn, "UPDATE bpjs SET harga = '$totaBayar', tanggal = '$tanggal' WHERE kode_pasien = '$kode_pasien'");
    if ($update) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update data']);
    }
    // echo json_encode(['status' => 'success']);

    foreach ($id_obat as $key => $value) {
        $sql = "UPDATE tb_obat SET stok = '$stok_update[$key]' WHERE kfa = '$value'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Stok updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update stok']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
}
