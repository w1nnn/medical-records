<?php

include "../../koneksi/koneksi.php";

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['order_id']) && isset($data['id_kwitansi'])) {
    $order_id = $data['order_id'];
    $id_kwitansi = $data['id_kwitansi'];

    $sql = "UPDATE tb_kwitansi SET order_id = '$order_id' WHERE id_kwitansi = '$id_kwitansi'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Order ID updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update order ID']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Order ID or id_kwitansi not provided']);
}

mysqli_close($conn);
