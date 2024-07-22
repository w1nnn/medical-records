<?php
if (isset($_GET['order_id'])) {
  $order_id = $_GET['order_id'];
  $url = "https://api.sandbox.midtrans.com/v2/$order_id/status";

  $headers = array(
    "accept: application/json",
    "authorization: Basic U0ItTWlkLXNlcnZlci16Z3A4Wkp3U2VGanBmVDNkX2ZrWkZGM0g6"
  );

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $response = curl_exec($ch);
  $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
  }
  curl_close($ch);

  header('Content-Type: application/json');
  if (isset($error_msg)) {
    echo json_encode(array("error" => $error_msg));
  } else {
    http_response_code($http_status);
    echo $response;
  }
} else {
  echo json_encode(array("error" => "order_id not provided"));
}
