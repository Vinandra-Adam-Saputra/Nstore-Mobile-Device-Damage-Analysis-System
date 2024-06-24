<?php
include 'config.php';

header('Content-Type: application/json');

if (isset($_GET['kerusakan'])) {
    $kerusakan = $conn->real_escape_string($_GET['kerusakan']);
    $sql = "SELECT deskripsi FROM kerusakan WHERE nama_kerusakan = '$kerusakan'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['description' => $row['deskripsi']]);
    } else {
        echo json_encode(['description' => null]);
    }
} else {
    echo json_encode(['error' => 'No kerusakan specified']);
}

$conn->close();