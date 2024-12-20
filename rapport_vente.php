<?php
include 'dbcon.php';

if (isset($_GET['id'])) {
    $payment_id = $_GET['id'];

    // Suppression du paiement
    $sql_delete = "DELETE FROM paiement WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();

    // Rediriger après la suppression
    header("Location: rapport.php"); // Remplacez 'rapport_vente.php' par le nom de votre page
    exit;
}
?>
