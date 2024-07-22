<?php
include "../../koneksi/koneksi.php";

// Ensure content-type is JSON
header('Content-Type: application/json');

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['no_rekmed']) && !empty($data['no_rekmed'])) {
    $no_rekmed = mysqli_real_escape_string($conn, $data['no_rekmed']);

    // Query to fetch resep data
    $query = "SELECT no_resep FROM tb_resep WHERE no_rekmed = '$no_rekmed'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $resepArray = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $resepArray[] = $row['no_resep'];
        }
        echo json_encode(['resep' => $resepArray]);
    } else {
        // Handle query execution errors
        echo json_encode(['error' => 'Query execution failed: ' . mysqli_error($conn)]);
    }
} else {
    // Handle missing or empty no_rekmed parameter
    echo json_encode(['error' => 'No or empty no_rekmed parameter provided']);
}
