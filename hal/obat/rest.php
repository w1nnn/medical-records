<?php
if (isset($_POST['nama_obat'])) {
    $namaObat = $_POST['nama_obat'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        'client_id' => 'avNTLub56CJ7Df8kjAJO3NJNGA9eD6gLOEa7SsDuVixiGnt0',
        'client_secret' => 'wZDklugM43NpUat5MuqAmUslYvdgLaEyQ9XLJRtGDCiHzrMsb2r2eMm2rcf5pJMI'
    )));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded'
    ));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $output = curl_exec($ch);

    if ($output === false) {
        echo json_encode(['error' => curl_error($ch)]);
        curl_close($ch);
        exit();
    }

    $data = json_decode($output, true);
    $access_token = $data['access_token'];

    curl_close($ch);

    $ch = curl_init();
    $product_url = "https://api-satusehat-stg.dto.kemkes.go.id/kfa-v2/products/all?page=1&size=100&product_type=farmasi&keyword=" . $namaObat;
    curl_setopt($ch, CURLOPT_URL, $product_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $access_token,
        'Accept: application/json'
    ));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $product_output = curl_exec($ch);

    if ($product_output === false) {
        echo json_encode(['error' => curl_error($ch)]);
    } else {
        $response = json_decode($product_output, true);
        echo json_encode($response);
    }

    curl_close($ch);
}
