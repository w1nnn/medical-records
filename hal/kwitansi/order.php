<?php

include "../../koneksi/koneksi.php";

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['order_id']) && isset($data['id_kwitansi'])) {
    $order_id = $data['order_id'];
    $id_kwitansi = $data['id_kwitansi'];
    $harga = $data['harga'];
    $stok = $data['stok'];
    $id_obat = $data['id_obat'];
    $status = $data['status'];
    $tanggal = $data['tanggal'];

    $sql = "UPDATE tb_kwitansi SET order_id = '$order_id', harga = '$harga', sts = '$status', tanggal = '$tanggal'  WHERE id_kwitansi = '$id_kwitansi'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Order ID updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update order ID']);
    }

    foreach ($id_obat as $key => $value) {
        $sql = "UPDATE tb_obat SET stok = '$stok[$key]' WHERE kfa = '$value'";
        mysqli_query($conn, $sql);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Order ID or id_kwitansi not provided']);
}

mysqli_close($conn);
