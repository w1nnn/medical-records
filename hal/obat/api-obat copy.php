<?php
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded'
));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$output = curl_exec($ch);

if ($output === false) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    $data = json_decode($output, true);
    $access_token = $data['access_token'];
}

curl_close($ch);

$ch = curl_init();
$product_url = "https://api-satusehat-stg.dto.kemkes.go.id/kfa-v2/products/all?page=1&size=1000&product_type=farmasi&keyword=" . urldecode($_POST['nama_obat']);
curl_setopt($ch, CURLOPT_URL, $product_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $access_token,
    'Accept: application/json'
));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$product_output = curl_exec($ch);

if ($product_output === false) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    $response = json_decode($product_output, true);
    echo "<pre>";
    echo json_encode($response, JSON_PRETTY_PRINT);
    echo "</pre>";
}

curl_close($ch);
