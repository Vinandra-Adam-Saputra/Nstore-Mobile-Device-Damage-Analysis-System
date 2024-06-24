<?php
include 'config.php';

$sql = "SELECT * FROM dataset";
$result = $conn->query($sql);

$dataset = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $dataset[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($dataset);

$conn->close();
?>