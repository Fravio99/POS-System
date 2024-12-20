<?php
include 'dbcon.php';

$sql = "SELECT ID, Nom FROM client";
$result = $conn->query($sql);

$clients = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clients[] = ['id' => $row['ID'], 'nom' => $row['Nom']];
    }
}

header('Content-Type: application/json');
echo json_encode($clients);

$conn->close();
?>
