<?php
require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

try {
    \Midtrans\Config::$serverKey = 'SB-Mid-server-zgp8ZJwSeFjpfT3d_fkZFF3H';
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $inputJson = file_get_contents('php://input');
    $input = json_decode($inputJson, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON input: ' . json_last_error_msg());
    }

    $orderId = 'ORDER-' . time();

    $params = array(
        'transaction_details' => array(
            'order_id' => $orderId,
            'gross_amount' => $input['price'] * $input['quantity'],
        ),
        'item_details' => array(
            array(
                'id' => $input['id'],
                'price' => $input['price'],
                'quantity' => $input['quantity'],
                'name' => $input['item']
            )
        ),
        'customer_details' => array(
            'first_name' => $input['name'],
            'last_name' => '',
            'email' => $input['email'],
            'phone' => $input['phone'],
        ),
    );

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    echo json_encode([
        'status' => 'success',
        'message' => 'Token generated successfully',
        'token' => $snapToken,
        'order_id' => $orderId
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
