<?php
include "../../koneksi/koneksi.php";

$rawData = file_get_contents("php://input");

error_log("Incoming raw data: " . $rawData);

$data = json_decode($rawData, true);

error_log("Decoded data: " . print_r($data, true));

if (isset($data['status_bayar']) && isset($data['order_id'])) {
    $status_bayar = $data['status_bayar'];
    $order_id = $data['order_id'];
    $update = mysqli_query($conn, "UPDATE tb_kwitansi SET sts = '$status_bayar' WHERE order_id = '$order_id'");
    if ($update) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update data']);
    }
    // echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
}
