<?php
include 'dbcon.php'; // Connexion à la base de données

// Vérifier si l'ID du produit est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer et exécuter la requête de suppression
    $query = "DELETE FROM client WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Si la suppression réussit, rediriger vers la liste des produits
        header("Location: customer.php"); // Assurez-vous que cette page est la bonne page d'affichage des produits
        exit();
    } else {
        // Si une erreur se produit
        echo "Erreur lors de la suppression du client.";
    }

    // Fermer la connexion
    $stmt->close();
} else {
    echo "ID du Client non spécifié.";
}
?>