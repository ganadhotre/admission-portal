<?php
include 'db_connection.php';

header('Content-Type: application/json');

function fetchAllColleges($conn) {
    $result = $conn->query("SELECT imageUrl, collegeName FROM colleges");
    $colleges = [];
    while ($row = $result->fetch_assoc()) {
        // Add the 'clgImage/' prefix if needed and not already there
        $imageUrl = $row['imageUrl'];
        if ($imageUrl && !str_starts_with($imageUrl, 'clgImage/')) {
            $imageUrl = 'clgImage/' . $imageUrl;
        }
        $row['imageUrl'] = $imageUrl;
        $colleges[] = $row;
    }
    return $colleges;
}

echo json_encode(fetchAllColleges($conn));
?>
