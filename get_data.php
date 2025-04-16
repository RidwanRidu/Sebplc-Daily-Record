<?php
require_once 'config.php';

header('Content-Type: application/json');

$sql = "SELECT * FROM outlet_data ORDER BY entry_date DESC";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
$conn->close();
?>