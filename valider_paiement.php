<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $payment_method = $_POST['payment_method'];
    $date_paiement = date('Y-m-d H:i:s');

    // Enregistrer le paiement dans la base de données
    $sql = "INSERT INTO paiement (client_id, payment_method, date_paiement) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $client_id, $payment_method, $date_paiement);
    $stmt->execute();

    // Redirection vers la page de génération de reçu
    header("Location: generer_recu.php?client_id=$client_id&payment_date=$date_paiement");
    exit();
}
?>
