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

    if (empty($input['items']) || !is_array($input['items'])) {
        throw new Exception("Items data is missing or invalid");
    }

    $orderId = 'ORDER-' . time();
    $grossAmount = 0;
    $itemDetails = [];

    foreach ($input['items'] as $item) {
        if (!isset($item['price'], $item['quantity'])) {
            throw new Exception("Missing price or quantity in item data");
        }
        $grossAmount += $item['price'] * $item['quantity'];
        $itemDetails[] = [
            'id' => $item['id'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'name' => $item['item']
        ];
    }

    $params = array(
        'transaction_details' => array(
            'order_id' => $orderId,
            'gross_amount' => $grossAmount,
        ),
        'item_details' => $itemDetails,
        'customer_details' => array(
            'first_name' => $input['name'],
            'last_name' => '',
            'email' => $input['email'],
            'phone' => $input['phone'],
        ),
    );

    // Log the parameters to debug
    // file_put_contents('log_params.txt', print_r($params, true), FILE_APPEND);

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
